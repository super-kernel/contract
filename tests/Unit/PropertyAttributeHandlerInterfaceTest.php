<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use SuperKernel\Contract\ContainerInterface;
use SuperKernel\Contract\PropertyAttributeHandlerInterface;
use SuperKernel\Contract\PropertyContextInterface;

use function array_map;
use function sort;

final class PropertyAttributeHandlerInterfaceTest extends TestCase
{
    public function testDeclaresTheContainerBoundPropertyHandlerContract(): void
    {
        $contract = new ReflectionClass(PropertyAttributeHandlerInterface::class);
        $constructor = $contract->getConstructor();
        $handle = $contract->getMethod('handle');

        self::assertTrue($contract->isInterface());
        self::assertNotNull($constructor);
        self::assertSame(1, $constructor->getNumberOfParameters());
        self::assertSame(ContainerInterface::class, (string) $constructor->getParameters()[0]->getType());
        self::assertSame(2, $handle->getNumberOfParameters());
        self::assertSame(PropertyContextInterface::class, (string) $handle->getParameters()[0]->getType());
        self::assertSame('object', (string) $handle->getParameters()[1]->getType());
        self::assertSame('void', (string) $handle->getReturnType());
    }

    public function testDeclaresThePropertyAssignmentContext(): void
    {
        $contract = new ReflectionClass(PropertyContextInterface::class);
        $methods = array_map(
            static fn(ReflectionMethod $method): string => $method->getName(),
            $contract->getMethods(),
        );
        sort($methods);

        self::assertTrue($contract->isInterface());
        self::assertSame(
            [
                'assign',
                'assignment',
                'className',
                'hasAssignment',
                'property',
            ],
            $methods,
        );
        self::assertSame('string', (string) $contract->getMethod('className')->getReturnType());
        self::assertSame(ReflectionProperty::class, (string) $contract->getMethod('property')->getReturnType());
        self::assertSame('bool', (string) $contract->getMethod('hasAssignment')->getReturnType());
        self::assertSame('mixed', (string) $contract->getMethod('assignment')->getReturnType());
        self::assertSame('mixed', (string) $contract->getMethod('assign')->getParameters()[0]->getType());
        self::assertSame('void', (string) $contract->getMethod('assign')->getReturnType());
    }
}
