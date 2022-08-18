# Unofficial (Proof of Concept) PHP SDK for Storyblok

This is a personal Proof of Concept SDK for integrating Storyblok.

This package aims to be compliant with the standards:
- [PSR-18](https://www.php-fig.org/psr/psr-18/)
- [PSR-7](https://www.php-fig.org/psr/psr-7/)
- [PSR-17](https://www.php-fig.org/psr/psr-17/)
- [PSR-12](https://www.php-fig.org/psr/psr-12/)

## Code Quality
For developing the package are used some nice tools from PHP ecosystem:

- [Pint](https://github.com/laravel/pint) for PHP code style fixer for [PSR-12](https://www.php-fig.org/psr/psr-17/)
- [PestPHP](https://pestphp.com/) for testing functions and methods
- [PHPStan](https://phpstan.org/) for static code analysis

The configurations are stored in pint.json (for Pint), phpstan.neon (for PHPStan) and phpunit.xml (for PestPHP).
The configuration files are stored in the repo in the root directory.
The execution of these tasks are orchestrated by composer run.
If you want to launch: testing, code style fixing, static code analysis simply run:

```shell
composer check
```

## Continuous Integration
The package is using GitHub Actions to test, and check the quality of the package on PHP 8.0 and PHP 8.1.
The workflow is configured in [.github/workflows/basic-check.yml](.github/workflows/basic-check.yml) file.



