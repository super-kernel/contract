<p align="right">
  <strong>English</strong> | <a href="README.zh-CN.md">中文文档</a>
</p>

# SuperKernel Contract

`super-kernel/contract` holds the interfaces that SuperKernel packages share, so that code can depend on a capability, such as the container, configuration, or reflection, without choosing the package that implements it.

## Installation

```bash
composer require super-kernel/contract
```

The package needs the `reflection` extension, which PHP includes by default, and installs `psr/container` and `psr/log`, whose interfaces two of its contracts extend. To obtain a working service for a contract, install the package that implements it.

## What it provides

- The container, application, and configuration contracts that application code receives by injection.
- The project path, package metadata, and Attribute metadata contracts that `skernel build` metadata is restored into.
- The event, listener, and exception dispatch contracts.
- The reflection, autoloading, and logging contracts.
- The extension contract for custom property Attributes.

It does not provide:

- an implementation, class, trait, or enum: it contains interfaces only;
- concrete events; `super-kernel/event` declares them;
- an execution-context abstraction; `super-kernel/context` offers its own static API.

## Quick start

Type a service against a contract. Save it as `src/Report/ClassReport.php`:

```php
<?php

declare(strict_types=1);

namespace Src\Report;

use ReflectionMethod;
use SuperKernel\Contract\ReflectorInterface;

use function count;

final readonly class ClassReport
{
    public function __construct(private ReflectorInterface $reflector)
    {
    }

    /**
     * @param class-string $class
     */
    public function describe(string $class): string
    {
        $reflection = $this->reflector->reflectClass($class);
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

        return $reflection->getShortName() . ' has ' . count($methods) . ' public methods';
    }
}
```

Give it a class to describe. Save it as `src/Billing/Invoice.php`:

```php
<?php

declare(strict_types=1);

namespace Src\Billing;

final class Invoice
{
    public function total(): int
    {
        return 0;
    }

    public function currency(): string
    {
        return 'EUR';
    }
}
```

In an application created from `super-kernel/skeleton`, the container supplies `super-kernel/reflector`'s implementation. Save the script as `bin/report.php`:

```php
<?php

declare(strict_types=1);

use Src\Billing\Invoice;
use Src\Report\ClassReport;
use SuperKernel\Context\ApplicationContext;

require dirname(__DIR__) . '/vendor/autoload.php';

echo ApplicationContext::getContainer()->get(ClassReport::class)->describe(Invoice::class), PHP_EOL;
```

Build the project and run the script:

```bash
skernel build
php bin/report.php
```

It prints `Invoice has 2 public methods`.

## Public surface

| Name | Kind | Purpose |
| --- | --- | --- |
| `SuperKernel\Contract\ContainerInterface` | Interface | The PSR-11 container of shared services; a class or interface identifier returns an instance of that type. |
| `SuperKernel\Contract\ApplicationInterface` | Interface | The application of the runtime; `run()` returns the process status. |
| `SuperKernel\Contract\ConfigInterface` | Interface | Checks and loads typed configuration items, optionally by name. |
| `SuperKernel\Contract\SingleConfigInterface` | Interface | Marks a configuration object that is itself the default item. |
| `SuperKernel\Contract\MultipleConfigInterface` | Interface | Marks a configuration source whose methods provide named items. |
| `SuperKernel\Contract\BasePathInterface` | Interface | The project directory, or the `phar://` root of a packaged application, as a string. |
| `SuperKernel\Contract\VendorDirInterface` | Interface | The Composer vendor directory as a string. |
| `SuperKernel\Contract\PackageManagerInterface` | Interface | The root and installed packages, their environment requirements, and their class maps. |
| `SuperKernel\Contract\PackageMetadataInterface` | Interface | One package: name, version, reference, and located path. |
| `SuperKernel\Contract\EnvironmentRequirementInterface` | Interface | One requirement on a Composer platform package and the package that declares it. |
| `SuperKernel\Contract\AnnotationCollectorInterface` | Interface | Finds the collected Attributes of classes, methods, and properties. |
| `SuperKernel\Contract\AttributeMetadataInterface` | Interface | One collected Attribute instance and its captured types. |
| `SuperKernel\Contract\PackageAnnotationsInterface` | Interface | The collected Attributes of one package. |
| `SuperKernel\Contract\ScanDiagnosticsInterface` | Interface | Returns the classes that `skernel build` could not collect. |
| `SuperKernel\Contract\PropertyAttributeHandlerInterface` | Interface | Implemented by the handler of a custom property Attribute. |
| `SuperKernel\Contract\PropertyContextInterface` | Interface | The property a handler processes, and its single assignment. |
| `SuperKernel\Contract\EventInterface` | Interface | Marks the events of SuperKernel packages. |
| `SuperKernel\Contract\ListenerInterface` | Interface | Implemented by an event listener: the events it handles and how it processes one. |
| `SuperKernel\Contract\ExceptionDispatcherInterface` | Interface | Passes a throwable to the exception handlers. |
| `SuperKernel\Contract\ReflectorInterface` | Interface | Returns PHP's native reflection objects, reused between calls. |
| `SuperKernel\Contract\AutoLoaderInterface` | Interface | The class loader of the process, its pending class map, and its interceptors. |
| `SuperKernel\Contract\StdoutLoggerInterface` | Interface | The PSR-3 logger that SuperKernel writes its records to. |

## Behavior to know

- A contract only works when a package implements it. Looking up a contract whose package is not installed fails in the container, with `SuperKernel\Di\Exception\NotFoundException` and the message `Container entry "<id>" has no definition.` in `super-kernel/di`.
- The exceptions named in the interfaces' PHPDoc are raised by the implementing packages, with the messages those packages document.
- Your own implementations of the Attribute metadata interfaces work at run time, but `super-kernel/annotator` publishes only its own models.

## Documentation

The developer documentation lists which package implements each contract and describes how to use each group, with links to the implementing packages: [SuperKernel Contract](https://github.com/super-kernel/.github/blob/main/docs/components/contract.md).

## License

Released under the MIT License. See [LICENSE](LICENSE).
