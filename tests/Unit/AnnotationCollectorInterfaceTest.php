<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use SuperKernel\Contract\AnnotationCollectorInterface;
use SuperKernel\Contract\PackageAnnotationsInterface;

use function array_map;
use function sort;

final class AnnotationCollectorInterfaceTest extends TestCase
{
    /** @throws ReflectionException When fixture setup or inspection fails */
    public function testDeclaresTheSharedAnnotationMetadataLookupBoundary(): void
    {
        $contract = new ReflectionClass(AnnotationCollectorInterface::class);
        $methods = array_map(
            static fn(ReflectionMethod $method): string => $method->getName(),
            $contract->getMethods(),
        );
        $getPackage = $contract->getMethod('getPackage');

        sort($methods);

        self::assertTrue($contract->isInterface());
        self::assertSame([], $contract->getInterfaceNames());
        self::assertSame([
            'getClassAttributes',
            'getClassesWithAttribute',
            'getClassesWithAttributeAssignableTo',
            'getMethodAttributes',
            'getMethodsWithAttribute',
            'getMethodsWithAttributeAssignableTo',
            'getPackage',
            'getPackages',
            'getPropertyAttributes',
        ], $methods);
        foreach ([
            'getMethodsWithAttribute',
            'getMethodsWithAttributeAssignableTo',
        ] as $name) {
            $method = $contract->getMethod($name);
            self::assertSame(1, $method->getNumberOfRequiredParameters());
            self::assertSame('string', (string) $method->getParameters()[0]->getType());
            self::assertSame('array', (string) $method->getReturnType());
        }

        self::assertSame(1, $getPackage->getNumberOfParameters());
        self::assertSame('string', (string) $getPackage->getParameters()[0]->getType());
        self::assertSame('?' . PackageAnnotationsInterface::class, (string) $getPackage->getReturnType());
    }
}
