# Super Kernel Contracts

[![Latest Stable Version](https://img.shields.io/packagist/v/super-kernel/contract.svg)](https://packagist.org/packages/super-kernel/contract)
[![License](https://img.shields.io/packagist/l/super-kernel/contract.svg)](https://packagist.org/packages/super-kernel/contract)

The **super-kernel/contract** package provides a set of core interface definitions and abstract standards for the Super
Kernel framework. It serves as the single source of truth for all components within the ecosystem, ensuring decoupling
and strict architectural integrity.

---

## 📌 Overview

In a modular ecosystem, components should depend on **abstractions**, not **implementations**. This package defines
the " rules of engagement" for Super Kernel. By requiring this package, your components stay lightweight and remain
compatible with any compliant implementation of the kernel.

## 🚀 Key Features

- **Standardization**: Uniform interfaces for Dependency Injection, Service Container, and Core Events.
- **Strict Decoupling**: Allows swapping underlying implementations without breaking dependent packages.
- **Architectural Guardrails**: Prevents implementation leakage and unauthorized scope elevation.

## 🛠 Installation

You can install the package via Composer:

```shell
composer require super-kernel/contract
```

## 📖 Usage & Best Practices

### 1. Dependency Injection (DI) Constraints

**Scope Note:** The following constraints apply strictly to components managed and instantiated via the **DI Container
**. Internal framework bootstrap components and third-party utility packages are excluded from these specific
enforcement rules.

Always type-hint the interfaces provided by this package in your constructors. Do not reference concrete classes from
implementation bundles.

**Correct Approach:**

```php
use SuperKernel\Contract\ContainerInterface;

final class MyService {
    public function __construct(
        private ContainerInterface $container // Depend on Contract
    )
    {
    }
}
```

### 2. Forbidden Operations

To maintain the stability and security of the kernel, the following operations are strictly prohibited for DI-managed
components:

- **Direct Instantiation**: Never use `new` on implementation classes. Always resolve via the Container.
- **Scope Elevation**: Do not attempt to bypass access modifiers or elevate the scope of internal kernel services.
- **Implementation Coupling**: Avoid checking for specific implementation types (e.g., `instanceof ConcreteService`).

---

## 🏗 Architecture Principles

This package follows the **Dependency Inversion Principle (DIP)**:

&emsp;&emsp;High-level modules should not depend on low-level modules. Both should depend on abstractions.

| Layer      | Responsibility                                   |
|:-----------|:-------------------------------------------------|
| Contracts  | "Defines ""What"" the system does (Interfaces)." |
| Components | Consume Contracts to provide features.           |
| Core       | "Implements the ""How"" (Concrete Logic)."       |

## 🤝 Contributing

Since this package defines the fundamental contracts for the entire framework, changes are subject to strict review.

&emsp;&emsp;1. Ensure all interface changes maintain backward compatibility (BC).

&emsp;&emsp;2. Update the corresponding implementation guides when adding new contracts.

## ⚖️ License

The Super Kernel Contracts is open-sourced software licensed under
the [MIT license](https://www.google.com/search?q=LICENSE).