<p align="right">
  <a href="README.md">English</a> | <strong>中文文档</strong>
</p>

# SuperKernel Contract

`super-kernel/contract` 存放 SuperKernel 各个相互独立的组件之间共享的接口。它只包含接口：依赖它可以让一个包面向共享边界编程，而不选定任何实现。安装实现某个契约的组件，即可从容器中获得该契约。

## 契约

- **应用**：`ApplicationInterface` 暴露所选应用的 `run(): int` 边界，不选定其具体的宿主或运行时。由 `super-kernel/framework` 实现。
- **项目路径**：`BasePathInterface` 继承 `Stringable`，返回规范的项目目录，或运行中应用的 `phar://` 根。`VendorDirInterface` 是另一个 `Stringable` 值，表示 Composer 依赖目录，该目录不一定存在。由 `super-kernel/composer` 实现。
- **容器**：`ContainerInterface` 是框架组件使用的共享服务边界，同时保留 PSR-11 互操作性。类和接口标识解析为兼容的实例；其他 PSR-11 标识可以返回任意值。由 `super-kernel/di` 实现。
- **配置**：`ConfigInterface::has(string $interface, ?string $name = null)` 和 `get(string $interface, ?string $name = null): ?object` 提供类型化配置。`SingleConfigInterface` 标记单个配置对象；`MultipleConfigInterface` 标记一个由带注解的条目方法组成的来源。只有一个条目时，它自动成为默认值。有多个条目时，不带名称的查询需要显式指定默认值；带名称的查询无需默认值也可使用。由 `super-kernel/config` 实现。
- **包**：`PackageManagerInterface` 提供确定顺序的根包和锁定包枚举、不区分大小写的名称查询、按声明类型精确过滤、环境要求、单包和汇总的类图，以及精确的类归属。包结果使用 `PackageMetadataInterface`；环境要求使用 `EnvironmentRequirementInterface`，包含平台名称、约束、声明它的包以及根包的开发标记。`version(): ?string` 返回声明的原始字符串，根 manifest 省略版本时返回 null，不做推断、规范化、比较或格式校验。需要依赖目录时注入 `VendorDirInterface`。由 `super-kernel/composer` 实现。
- **自动加载**：`AutoLoaderInterface` 涵盖 SPL 调用、待加载映射、预加载拦截器，以及注册和移除状态。移除失败是 `RuntimeException`。由 `super-kernel/autoloader` 实现。
- **注解收集**：`AnnotationCollectorInterface` 提供感知包边界的、对类、方法和属性注解的精确查询与可赋值查询。查询通过 `AttributeMetadataInterface<T>`（`name()`、`attribute()` 和 `types()`）返回可信的注解实例；方法结果保留声明类、确切的方法名、首个归属包以及有序的匹配元数据。`PackageAnnotationsInterface` 暴露单个包的名称、reference 以及声明的类、方法和属性映射。由 `super-kernel/annotator` 实现。
- **属性注入**：`PropertyAttributeHandlerInterface` 和 `PropertyContextInterface` 通过赋值上下文，把原生属性注解绑定到与容器关联的处理器。由 `super-kernel/di` 使用。
- **事件**：`EventInterface` 标记框架和组件的事件，不规定载荷形状、监听器行为或分发器实现。框架事件由 `super-kernel/event` 声明。
- **监听器**：`ListenerInterface` 暴露监听器处理的事件类名索引列表，以及处理匹配事件的、以 object 为参数类型的 `process()` 入口。声明了多个事件的实现在 `process()` 内部区分具体事件。由 `super-kernel/event-dispatcher` 分发。
- **异常分发**：`ExceptionDispatcherInterface` 接收一个 `Throwable`，返回 `void`。由 `super-kernel/exception-dispatcher` 实现。
- **反射**：`ReflectorInterface` 返回可复用的原生 `Reflection*` 对象，不转换 PHP 原生的检查 API 和失败行为。由 `super-kernel/reflector` 实现。
- **具名日志**：`StdoutLoggerInterface` 标识 SuperKernel 用于框架和异常记录的 PSR-3 stdout 服务，不选定处理器、格式器、通道或最低级别。应用可以替换其传输、阈值和格式器。由 `super-kernel/logger` 实现。

## 注解元数据

`AnnotationCollectorInterface::getPackage()` 返回 `?PackageAnnotationsInterface`，数组结果也暴露共享的元数据接口，因此使用方可以提供独立的元数据实现，而不必依赖 Annotator 的具体模型。这些接口不保证任意实现都支持序列化：Annotator 的缓存只接受它自己的模型。

## 扫描诊断能力

`ScanDiagnosticsInterface` 是一个独立的只读能力，只有 `getDiagnostics(): array`。它不是额外的收集器绑定。Annotator 的包和集合实现了它；其他 `AnnotationCollectorInterface` 和 `PackageAnnotationsInterface` 实现无需添加任何方法。

每一行恰好包含 `sequence`（扫描范围内的正整数）、`package`（规范化的非空归属包名）、`class`、`exception_type`（非空的捕获字符串）和 `message`（原始字符串字节）。单个包暴露它自己的子集，完整的集合按扫描顺序合并各个子集。捕获的名称不必在运行时存在，也不得为了读取诊断而触发自动加载。契约中不包含任何 Throwable。

```php
use SuperKernel\Contract\AnnotationCollectorInterface;
use SuperKernel\Contract\ScanDiagnosticsInterface;

/** @var AnnotationCollectorInterface $collector */
if ($collector instanceof ScanDiagnosticsInterface) {
    $diagnostics = $collector->getDiagnostics();
}
```
