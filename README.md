# SuperKernel Contract

`super-kernel/contract` is the dependency-inversion boundary for public interfaces shared by otherwise independent
SuperKernel components. Its production source contains interfaces only. It depends on `ext-reflection` for native
reflection return types, `psr/container` for the PSR-11 container boundary, and `psr/log` for the named PSR-3 stdout
logger boundary; depending on this package still does not select any implementation.

Every admitted interface is a framework-level public port that all components can understand and follow. Each one is
declared directly in the `SuperKernel\Contract` namespace and stored directly under `src/`; the component that first
needs a contract does not own a child namespace here. Component-private interfaces and richer component APIs remain
with their owning components.

The current contracts cover fourteen shared responsibilities:

- Application execution exposes the framework-selected application's `run(): int` boundary without selecting its
  concrete host or runtime.
- Project base paths use `BasePathInterface`, which extends `Stringable` and declares `__toString(): string`. It returns
  the canonical project directory or the running application's `phar://` root; Composer owns the value implementation,
  environment detection, and factory provider.
- Composer dependency paths use `VendorDirInterface`, a separate Stringable value whose directory need not exist.
  Composer's factory resolves the root package's `config.vendor-dir` against an injected `BasePathInterface`.
- Container lookup defines the shared-service boundary used by framework components while retaining PSR-11
  interoperability. Class and interface identifiers resolve to compatible instances; other PSR-11 identifiers may
  return any value.
- Typed configuration uses `ConfigInterface::has(string $interface, ?string $name = null)` and
  `get(string $interface, ?string $name = null): ?object`. `SingleConfigInterface` marks one configuration object;
  `MultipleConfigInterface` marks a source of attributed item methods. A sole item is automatically the default.
  With several items, unnamed lookup requires an explicit default; named lookups remain available without one.
  Config owns discovery, names, defaults, retained identity, cycles, and concrete exceptions. Domain validation
  remains with consuming components; shared exception annotations use PSR-11 contracts.
- Composer package management uses `PackageManagerInterface` for deterministic root and locked package enumeration,
  case-insensitive name lookup, exact declared-type filtering, environment requirements, per-package and aggregate
  class maps, and exact class ownership. Package results use `PackageMetadataInterface`; environment requirements use
  `EnvironmentRequirementInterface` for the platform name, constraint, declaring package, and root development flag.
  Shared metadata exposes `version(): ?string`: the exact declared string, or null when the root manifest omits it.
  It performs no version inference, normalization, comparison, or format validation. Composer's file reader validates
  JSON structure and string types; the Composer tool owns version-format validation.
  Consumers obtain the dependency directory separately through an injected `VendorDirInterface`.
- Classmap autoloading uses `AutoLoaderInterface` for SPL invocation, pending mappings, preload interceptors, and
  registration/removal status. Autoloader owns the implementation, factory, loader construction, and concrete
  exceptions; shared removal failures are documented as `RuntimeException` without requiring that implementation.
- Native Attribute collection exposes package-aware exact and assignable lookup plus class, method, and property
  metadata retrieval without selecting the scanner, persistence lifecycle, or collector implementation. Exact and
  assignable queries promise trusted Attribute instances through `AttributeMetadataInterface<T>` (`name()`,
  `attribute()`, and `types()`). `PackageAnnotationsInterface` exposes the package name, reference, and declared class,
  method, and property maps. These read interfaces select no serialization or model implementation; Annotator still
  owns its concrete values. `AnnotationCollectorInterface` includes exact and assignable method discovery. Results retain declaring
  classes, exact method names, first-package ownership, and ordered matching metadata. Consumers query the injected collector directly; Annotator owns the concrete indexes.
- DI property processing binds discovered native property Attributes to container-bound handlers through an assignment
  context without selecting a concrete container implementation.
- Event identity marks framework and component events without prescribing payload shape, listener behavior, or a
  dispatcher implementation.
- Listener declaration exposes the indexed list of event class names handled by a listener and the object-typed
  `process()` entry point that handles matching events, without selecting listener discovery, priority metadata, or a
  dispatcher implementation. Implementations that declare multiple events distinguish the concrete event inside
  `process()`.
- Exception handling defines only the throwable dispatcher boundary. The dispatcher accepts one `Throwable` and
  returns `void`; handler discovery, ordering, declaration matching, fallback formatting, logging, and
  protocol-specific results remain with their owning implementations.
- Reflection exposes reusable native `Reflection*` objects without selecting the owning cache implementation or
  translating PHP's native inspection API and failures.
- Named logging identifies SuperKernel's PSR-3 stdout service for framework and exception records without selecting a
  logger implementation, handler, formatter, channel, or minimum level.

Concrete applications, containers, exception handlers and providers, execution contexts, events, listeners,
property-handler dispatchers, event dispatching, metadata, package scanning, filesystem storage, serialization, and
class loading remain in their owning components.

## Annotation metadata

`AnnotationCollectorInterface::getPackage()` returns `?PackageAnnotationsInterface`; array results expose shared
metadata interfaces. Annotator's collector uses these same types for its constructor input, stored indexes, and
public lookups, retaining supplied instances directly. Consumers can use independent metadata implementations
without requiring a concrete Annotator model. Contract has no production dependency on Annotator.

These interfaces do not promise serialization support for arbitrary implementations. Annotator's cache continues to
admit only its own models, with validated class names, properties, serialized schema, and restoration allow-list.

## Scan diagnostics capability

`ScanDiagnosticsInterface` is an independent read capability with only `getDiagnostics(): array`. It is not an
additional collector binding. Annotator packages and collections implement it; existing
`AnnotationCollectorInterface` and `PackageAnnotationsInterface` implementations need not add methods.

Rows contain exactly `sequence` (positive scan-wide integer), `package` (normalized non-empty owner name), `class`,
`exception_type` (non-empty captured strings), and `message` (original string bytes). A package exposes its subset,
while a complete collection combines subsets in scan order. Captured names need not exist in the runtime and must not
be autoloaded just to read diagnostics. No Throwable is part of the contract.

```php
use SuperKernel\Contract\AnnotationCollectorInterface;
use SuperKernel\Contract\ScanDiagnosticsInterface;

/** @var AnnotationCollectorInterface $collector */
if ($collector instanceof ScanDiagnosticsInterface) {
    $diagnostics = $collector->getDiagnostics();
}
```

Annotator owns validation, persistence, and schema migration. DI owns bootstrap reporting through the existing
`StdoutLoggerInterface`. That port remains a methodless PSR-3 extension: its default implementation writes stdout,
but applications may replace transport, threshold, and formatter. Contract contains no logger or scan implementation.

## Development

Use a PHP 8.4 Composer in this package's checkout:

```bash
composer install
composer validate --strict
composer test
composer format:check
composer format
```
