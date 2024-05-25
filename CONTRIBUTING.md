# Contributing

If you're keen to contribute, follow these steps:

## Reporting a Bug

Before submitting a bug:

- Review the project documentation.
- Familiarize yourself with the lexoffice public API documentation.
- If you're sure it's a bug, use the official bug tracker and adhere to these guidelines:

1. Use a clear title to describe the issue.
2. Provide concise steps to reproduce the bug, ideally with code examples or a failing unit test.
3. For complex issues or multi-layered impacts, include a reproducer.
4. Furnish comprehensive details about your environment (OS, PHP version, Symfony version, enabled extensions, etc.).
5. If an exception occurred, supply the stack trace. For HTML pages, provide the plain text version at the bottom of the page. Avoid screenshots for indexing purposes. Similarly, for terminal errors, avoid screenshots and opt for copy/pasting the contents. If the stack trace is extensive, consider enclosing it in a "Details" section.
6. Optionally, attach a patch.

## Use docker for local development

This bundle contains a docker setup for local development.

You can use `make` to run the docker container:

```shell
make up # Start the docker container
make sh # Open the shell of the php container
```

## Coding Standards

We using PHP-Codesniffer to ensure coding styles and standards. The rules are defined in our [coding-standard composer package](https://git.var-lab.com/var-lab.com/coding-standard-php).

### Check the code

```
composer run lint:php
```

### Run the fixer

```
composer run lint:php:fix
```

## Running tests

```
composer run tests
composer run tests:unit
composer run tests:integration
```
