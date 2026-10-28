<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use Attribute;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;
use SuperKernel\Contract\AnnotationCollectorInterface;
use SuperKernel\Contract\AttributeMetadataInterface;
use SuperKernel\Contract\PackageAnnotationsInterface;

use function array_filter;
use function array_values;
use function get_declared_classes;
use function spl_autoload_register;
use function spl_autoload_unregister;
use function str_starts_with;

final class AnnotationMetadataInterfaceTest extends TestCase
{
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testCollectorsAcceptSharedMetadataWithoutLoadingAnnotator(): void
    {
        $rejectAnnotator = static function (string $class): void {
            if (str_starts_with($class, 'SuperKernel\\Annotator\\')) {
                self::fail('Contract must not load ' . $class);
            }
        };
        spl_autoload_register($rejectAnnotator, true, true);

        try {
            $attribute = new Attribute(Attribute::TARGET_METHOD);
            $metadata = $this->createStub(AttributeMetadataInterface::class);
            $metadata->method('name')->willReturn(Attribute::class);
            $metadata->method('attribute')->willReturn($attribute);
            $metadata->method('types')->willReturn([
                Attribute::class,
            ]);
            $methods = [
                self::class => [
                    'handle' => [
                        $metadata,
                    ],
                ],
            ];
            $package = $this->createStub(PackageAnnotationsInterface::class);
            $package->method('packageName')->willReturn('acme/standalone');
            $package->method('reference')->willReturn(null);
            $package->method('classAttributes')->willReturn([]);
            $package->method('methodAttributes')->willReturn($methods);
            $package->method('propertyAttributes')->willReturn([]);
            $collector = $this->createStub(AnnotationCollectorInterface::class);
            $collector->method('getPackage')->willReturn($package);
            $collector->method('getPackages')->willReturn([
                'acme/standalone' => $package,
            ]);
            $collector->method('getMethodAttributes')->willReturn([
                $metadata,
            ]);
            $collector->method('getMethodsWithAttribute')->willReturn($methods);

            self::assertSame($package, $collector->getPackage('acme/standalone'));
            self::assertSame($package, $collector->getPackages()['acme/standalone']);
            self::assertSame('acme/standalone', $package->packageName());
            self::assertNull($package->reference());
            self::assertSame([], $package->classAttributes());
            self::assertSame([], $package->propertyAttributes());
            self::assertSame($methods, $package->methodAttributes());
            self::assertSame($metadata, $collector->getMethodAttributes(self::class, 'handle')[0]);
            self::assertSame($methods, $collector->getMethodsWithAttribute(Attribute::class));
            self::assertSame($attribute, $metadata->attribute());
            self::assertSame(Attribute::class, $metadata->name());
            self::assertSame([
                Attribute::class,
            ], $metadata->types());

            self::assertSame([], array_values(array_filter(
                get_declared_classes(),
                static fn(string $class): bool => str_starts_with($class, 'SuperKernel\\Annotator\\'),
            )));
        } finally {
            spl_autoload_unregister($rejectAnnotator);
        }
    }
}
