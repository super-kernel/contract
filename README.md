# Super Kernel Contracts

[![Latest Stable Version](https://img.shields.io/packagist/v/super-kernel/contract.svg)](https://packagist.org/packages/super-kernel/contract)
[![License](https://img.shields.io/packagist/l/super-kernel/contract.svg)](https://packagist.org/packages/super-kernel/contract)

`super-kernel/contract` contains the small set of interfaces shared by Super Kernel core packages. It defines the
runtime contracts for containers, application execution, attribute metadata, package discovery, class loading,
reflection, logging, scanning, path resolution, and event listeners.

The package is intentionally implementation-light. It depends only on the PSR interfaces that its own interfaces extend:
PSR-11 for containers and PSR-3 for logging.

## Installation

Requires PHP 8.4 or later.

```shell
composer require super-kernel/contract
```

## Attribute Metadata

PHP attributes are represented through two contracts:

- `AttributeMetadataInterface` describes one collected attribute instance and its declaring target.
- `AttributeCollectorInterface` exposes target-based and attribute-class-based lookup methods.

Supported targets are classes, methods, properties, class constants, and method parameters. The package uses Attribute
terminology directly; older Annotation naming is intentionally not part of the core contract.

## Core Boundaries

Core packages should depend on these interfaces instead of concrete implementations. Implementations may use any runtime
library internally, but those choices should not leak into this package unless the interface itself extends an external
standard.

## License

The Super Kernel Contracts package is open-sourced software licensed under the [MIT license](LICENSE).
