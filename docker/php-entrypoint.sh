#!/bin/sh
set -xe

exec docker-php-entrypoint "$@"
