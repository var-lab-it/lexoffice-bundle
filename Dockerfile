# the different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target

# -------------
# generic php base image
# -------------
FROM php:8.1-fpm-alpine AS base

RUN apk update
RUN apk add --no-cache \
  git \
  fcgi

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS linux-headers \
    && docker-php-ext-install -j$(nproc) \
    sockets \
    posix \
    pcntl \
    &&  rm -rf /tmp/pear \
    && apk del .build-deps

#RUN docker-php-ext-enable apcu
COPY --from=composer:2.5.1 /usr/bin/composer /usr/local/bin/composer

VOLUME /var/run/php

COPY docker/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

COPY docker/php-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

COPY docker/docker-healthcheck.sh /usr/local/bin/docker-healthcheck
RUN chmod +x /usr/local/bin/docker-healthcheck
HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["docker-healthcheck"]

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

# -------------
# generic build
# -------------
FROM base AS build_generic

#ARG CI_JOB_TOKEN=
ARG COMPOSER_AUTH=

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_AUTH=${COMPOSER_AUTH}

WORKDIR /srv/php

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.json .
COPY composer.lock ./
COPY src src/

RUN mkdir -p var/log

VOLUME /srv/php/var

# ---------
# prod build
# ---------
FROM build_generic AS build_prod

WORKDIR /srv/php

RUN composer install --prefer-dist --no-dev --no-scripts --no-progress -v && \
    composer clear-cache

ENV APP_ENV=prod

RUN composer dump-autoload --classmap-authoritative --no-dev && \
    composer run-script --no-dev post-install-cmd && \
    chmod +x bin/console && \
    sync

# ---------
# dev build
# ---------
FROM build_generic AS build_dev

COPY tests tests/
COPY phpunit.xml.dist phpstan.neon ./

RUN composer install --prefer-dist --no-scripts --no-progress && \
    composer clear-cache

RUN composer dump-autoload && \
    composer run-script post-install-cmd || \
    chmod +x bin/console && \
    sync

# --------------
# php prod image
# --------------
FROM base AS php

WORKDIR /srv/php

RUN ln -sf $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

# Modify memory limit
RUN echo 'memory_limit = 512M' >> $PHP_INI_DIR/conf.d/memory_limit_php.ini

COPY --from=build_prod /srv/php /srv/php
RUN chown -R www-data var

# -------------
# php dev image
# -------------
FROM base AS php_dev

WORKDIR /srv/php

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS linux-headers \
    && pecl install xdebug-3.2.0 \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps

ARG COMPOSER_AUTH=

RUN wget -O /usr/local/bin/local-php-security-checker https://github.com/fabpot/local-php-security-checker/releases/download/v1.0.0/local-php-security-checker_1.0.0_linux_amd64 \
    && chmod +x /usr/local/bin/local-php-security-checker

COPY phpunit.xml.dist phpstan.neon ./
COPY --from=build_dev /srv/php /srv/php
RUN chown -R www-data var

RUN ln -sf $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

# Modify memory limit
RUN echo 'memory_limit = 1024M' >> $PHP_INI_DIR/conf.d/memory_limit_php.ini

RUN apk add --no-cache nodejs npm && \
    npm install -g json-server

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_AUTH=${COMPOSER_AUTH}
