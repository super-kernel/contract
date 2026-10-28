<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionConstant;
use ReflectionEnum;
use ReflectionEnumBackedCase;
use ReflectionEnumUnitCase;
use ReflectionExtension;
use ReflectionFiber;
use ReflectionFunction;
use ReflectionGenerator;
use ReflectionMethod;
use ReflectionObject;
use ReflectionParameter;
use ReflectionProperty;
use ReflectionReference;
use ReflectionZendExtension;
use SuperKernel\Contract\ReflectorInterface;

use function array_map;
use function ksort;
use function sort;

final class ReflectorInterfaceTest extends TestCase
{
    public function testDeclaresTheSharedNativeReflectionContract(): void
    {
        $contract = new ReflectionClass(ReflectorInterface::class);
        $methods = array_map(
            static fn(ReflectionMethod $method): string => $method->getName(),
            $contract->getMethods(),
        );
        $returnTypes = [];

        foreach ($contract->getMethods() as $method) {
            $returnTypes[$method->getName()] = (string) $method->getReturnType();
        }

        sort($methods);
        ksort($returnTypes);

        self::assertTrue($contract->isInterface());
        self::assertSame([], $contract->getInterfaceNames());
        self::assertSame([
            'reflectClass',
            'reflectClassConstant',
            'reflectConstant',
            'reflectEnum',
            'reflectEnumBackedCase',
            'reflectEnumUnitCase',
            'reflectExtension',
            'reflectFiber',
            'reflectFunction',
            'reflectGenerator',
            'reflectMethod',
            'reflectObject',
            'reflectParameter',
            'reflectProperty',
            'reflectReference',
            'reflectZendExtension',
        ], $methods);
        self::assertSame([
            'reflectClass'          => ReflectionClass::class,
            'reflectClassConstant'  => ReflectionClassConstant::class,
            'reflectConstant'       => ReflectionConstant::class,
            'reflectEnum'           => ReflectionEnum::class,
            'reflectEnumBackedCase' => ReflectionEnumBackedCase::class,
            'reflectEnumUnitCase'   => ReflectionEnumUnitCase::class,
            'reflectExtension'      => ReflectionExtension::class,
            'reflectFiber'          => ReflectionFiber::class,
            'reflectFunction'       => ReflectionFunction::class,
            'reflectGenerator'      => ReflectionGenerator::class,
            'reflectMethod'         => ReflectionMethod::class,
            'reflectObject'         => ReflectionObject::class,
            'reflectParameter'      => ReflectionParameter::class,
            'reflectProperty'       => ReflectionProperty::class,
            'reflectReference'      => '?' . ReflectionReference::class,
            'reflectZendExtension'  => ReflectionZendExtension::class,
        ], $returnTypes);
    }
}
