<p align="right">
  <strong>English</strong> | <a href="README.zh-CN.md">中文文档</a>
</p>

# SuperKernel Contract

`super-kernel/contract` holds the interfaces shared by otherwise independent SuperKernel components. It contains interfaces only: depending on it lets a package type against a shared boundary without selecting an implementation. Install the component that implements a contract to obtain it from the container.

## Contracts

- **Application**: `ApplicationInterface` exposes the selected application's `run(): int` boundary without selecting its concrete host or runtime. Implemented by `super-kernel/framework`.
- **Project paths**: `BasePathInterface` extends `Stringable` and returns the canonical project directory or the running application's `phar://` root. `VendorDirInterface` is a separate `Stringable` value for the Composer dependency directory, which need not exist. Implemented by `super-kernel/composer`.
- **Container**: `ContainerInterface` is the shared-service boundary used by framework components while retaining PSR-11 interoperability. Class and interface identifiers resolve to compatible instances; other PSR-11 identifiers may return any value. Implemented by `super-kernel/di`.
- **Configuration**: `ConfigInterface::has(string $interface, ?string $name = null)` and `get(string $interface, ?string $name = null): ?object` provide typed configuration. `SingleConfigInterface` marks one configuration object; `MultipleConfigInterface` marks a source of attributed item methods. A sole item is automatically the default. With several items, unnamed lookup requires an explicit default; named lookups remain available without one. Implemented by `super-kernel/config`.
- **Packages**: `PackageManagerInterface` provides deterministic root and locked package enumeration, case-insensitive name lookup, exact declared-type filtering, environment requirements, per-package and aggregate class maps, and exact class ownership. Package results use `PackageMetadataInterface`; environment requirements use `EnvironmentRequirementInterface` for the platform name, constraint, declaring package, and root development flag. `version(): ?string` returns the exact declared string, or null when the root manifest omits it, without inference, normalization, comparison, or format validation. Inject `VendorDirInterface` for the dependency directory. Implemented by `super-kernel/composer`.
- **Autoloading**: `AutoLoaderInterface` covers SPL invocation, pending mappings, preload interceptors, and registration and removal status. Removal failures are `RuntimeException`. Implemented by `super-kernel/autoloader`.
- **Attribute collection**: `AnnotationCollectorInterface` provides package-aware exact and assignable lookup of class, method, and property Attributes. Lookups return trusted Attribute instances through `AttributeMetadataInterface<T>` (`name()`, `attribute()`, and `types()`), and method results keep their declaring classes, exact method names, first-package ownership, and ordered matching metadata. `PackageAnnotationsInterface` exposes one package's name, reference, and declared class, method, and property maps. Implemented by `super-kernel/annotator`.
- **Property injection**: `PropertyAttributeHandlerInterface` and `PropertyContextInterface` bind native property Attributes to container-bound handlers through an assignment context. Consumed by `super-kernel/di`.
- **Events**: `EventInterface` marks framework and component events without prescribing payload shape, listener behavior, or a dispatcher implementation. Framework events are declared by `super-kernel/event`.
- **Listeners**: `ListenerInterface` exposes the indexed list of event class names a listener handles and the object-typed `process()` entry point for matching events. Implementations that declare multiple events distinguish the concrete event inside `process()`. Dispatched by `super-kernel/event-dispatcher`.
- **Exception dispatch**: `ExceptionDispatcherInterface` accepts one `Throwable` and returns `void`. Implemented by `super-kernel/exception-dispatcher`.
- **Reflection**: `ReflectorInterface` returns reusable native `Reflection*` objects without translating PHP's native inspection API and failures. Implemented by `super-kernel/reflector`.
- **Named logging**: `StdoutLoggerInterface` identifies SuperKernel's PSR-3 stdout service for framework and exception records without selecting a handler, formatter, channel, or minimum level. Applications may replace its transport, threshold, and formatter. Implemented by `super-kernel/logger`.

## Annotation metadata

`AnnotationCollectorInterface::getPackage()` returns `?PackageAnnotationsInterface`, and array results expose the shared metadata interfaces, so consumers can provide independent metadata implementations without a concrete Annotator model. These interfaces do not promise serialization support for arbitrary implementations: Annotator's cache admits only its own models.

## Scan diagnostics capability

`ScanDiagnosticsInterface` is an independent read capability with only `getDiagnostics(): array`. It is not an additional collector binding. Annotator packages and collections implement it; other `AnnotationCollectorInterface` and `PackageAnnotationsInterface` implementations need not add methods.

Rows contain exactly `sequence` (positive scan-wide integer), `package` (normalized non-empty owner name), `class`, `exception_type` (non-empty captured strings), and `message` (original string bytes). A package exposes its subset, while a complete collection combines subsets in scan order. Captured names need not exist in the runtime and must not be autoloaded just to read diagnostics. No Throwable is part of the contract.

```php
use SuperKernel\Contract\AnnotationCollectorInterface;
use SuperKernel\Contract\ScanDiagnosticsInterface;

/** @var AnnotationCollectorInterface $collector */
if ($collector instanceof ScanDiagnosticsInterface) {
    $diagnostics = $collector->getDiagnostics();
}
```
