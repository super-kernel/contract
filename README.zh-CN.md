<p align="right">
  <a href="README.md">English</a> | <strong>中文文档</strong>
</p>

# SuperKernel Contract

`super-kernel/contract` 收录 SuperKernel 各个包共享的接口，使代码可以依赖某种能力（例如容器、配置或反射），而无需选定实现它的包。

## 安装

```bash
composer require super-kernel/contract
```

本包需要 PHP 默认自带的 `reflection` 扩展，并会安装 `psr/container` 和 `psr/log`，其中两个契约扩展了它们的接口。要为某个契约获得可用的服务，请安装实现它的包。

## 提供的能力

- 应用代码通过注入接收的容器、应用和配置契约。
- `skernel build` 的元数据被恢复成的项目路径、包元数据和注解元数据契约。
- 事件、监听器和异常分发契约。
- 反射、自动加载和日志契约。
- 用于自定义属性注解的扩展契约。

它不提供：

- 实现、类、trait 或枚举：它只包含接口；
- 具体的事件，这由 `super-kernel/event` 声明；
- 执行上下文的抽象；`super-kernel/context` 提供它自己的静态 API。

## 快速开始

面向一个契约编写服务。将它保存为 `src/Report/ClassReport.php`：

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

给它一个要描述的类。将它保存为 `src/Billing/Invoice.php`：

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

在由 `super-kernel/skeleton` 创建的应用中，容器提供 `super-kernel/reflector` 的实现。将脚本保存为 `bin/report.php`：

```php
<?php

declare(strict_types=1);

use Src\Billing\Invoice;
use Src\Report\ClassReport;
use SuperKernel\Context\ApplicationContext;

require dirname(__DIR__) . '/vendor/autoload.php';

echo ApplicationContext::getContainer()->get(ClassReport::class)->describe(Invoice::class), PHP_EOL;
```

构建项目并运行脚本：

```bash
skernel build
php bin/report.php
```

它会打印 `Invoice has 2 public methods`。

## 公开接口

| 名称 | 类别 | 用途 |
| --- | --- | --- |
| `SuperKernel\Contract\ContainerInterface` | 接口 | 共享服务的 PSR-11 容器；类或接口标识符返回该类型的实例。 |
| `SuperKernel\Contract\ApplicationInterface` | 接口 | 运行时的应用；`run()` 返回进程状态。 |
| `SuperKernel\Contract\ConfigInterface` | 接口 | 检查并加载类型化的配置项，可以按名称查找。 |
| `SuperKernel\Contract\SingleConfigInterface` | 接口 | 标记一个自身就是默认配置项的配置对象。 |
| `SuperKernel\Contract\MultipleConfigInterface` | 接口 | 标记一个由其方法提供具名配置项的配置来源。 |
| `SuperKernel\Contract\BasePathInterface` | 接口 | 项目目录（或打包后应用的 `phar://` 根），以字符串形式提供。 |
| `SuperKernel\Contract\VendorDirInterface` | 接口 | Composer 的依赖目录（vendor 目录），以字符串形式提供。 |
| `SuperKernel\Contract\PackageManagerInterface` | 接口 | 根包和已安装的包、它们的环境要求以及类映射。 |
| `SuperKernel\Contract\PackageMetadataInterface` | 接口 | 一个包：名称、版本、引用和所在路径。 |
| `SuperKernel\Contract\EnvironmentRequirementInterface` | 接口 | 对某个 Composer 平台包的一项要求，以及声明它的包。 |
| `SuperKernel\Contract\AnnotationCollectorInterface` | 接口 | 查找类、方法和属性上收集到的注解。 |
| `SuperKernel\Contract\AttributeMetadataInterface` | 接口 | 一个收集到的注解实例及其捕获的类型。 |
| `SuperKernel\Contract\PackageAnnotationsInterface` | 接口 | 一个包中收集到的注解。 |
| `SuperKernel\Contract\ScanDiagnosticsInterface` | 接口 | 返回 `skernel build` 无法收集的类。 |
| `SuperKernel\Contract\PropertyAttributeHandlerInterface` | 接口 | 由自定义属性注解的处理器实现。 |
| `SuperKernel\Contract\PropertyContextInterface` | 接口 | 处理器所处理的属性及其唯一一次赋值。 |
| `SuperKernel\Contract\EventInterface` | 接口 | 标记 SuperKernel 各个包的事件。 |
| `SuperKernel\Contract\ListenerInterface` | 接口 | 由事件监听器实现：它处理哪些事件，以及如何处理一个事件。 |
| `SuperKernel\Contract\ExceptionDispatcherInterface` | 接口 | 把一个 throwable 交给异常处理器。 |
| `SuperKernel\Contract\ReflectorInterface` | 接口 | 返回 PHP 原生的反射对象，在多次调用之间复用。 |
| `SuperKernel\Contract\AutoLoaderInterface` | 接口 | 进程的类加载器、它的待加载类映射和拦截器。 |
| `SuperKernel\Contract\StdoutLoggerInterface` | 接口 | SuperKernel 写入日志记录所用的 PSR-3 日志记录器。 |

## 需要了解的行为

- 契约只有在某个包实现了它时才可用。查找一个其实现包未安装的契约会在容器中失败；在 `super-kernel/di` 中抛出 `SuperKernel\Di\Exception\NotFoundException`，消息为 `Container entry "<id>" has no definition.`。
- 接口 PHPDoc 中提到的异常由实现它们的包抛出，消息见这些包的文档。
- 你自己对注解元数据接口的实现可以在运行时使用，但 `super-kernel/annotator` 只发布它自己的模型。

## 文档

开发者文档列出了每个契约由哪个包实现，并说明了如何使用每一组契约，附有指向实现包的链接：[SuperKernel Contract](https://github.com/super-kernel/.github/blob/main/docs/components/contract.zh-CN.md)。

## 许可证

基于 MIT 许可证发布，详见 [LICENSE](LICENSE)。
