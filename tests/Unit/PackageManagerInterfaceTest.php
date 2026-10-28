<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use SuperKernel\Contract\PackageManagerInterface;
use SuperKernel\Contract\PackageMetadataInterface;
use Throwable;

use function array_map;

final class PackageManagerInterfaceTest extends TestCase
{
    /** @throws Throwable When reflection or fixture creation fails */
    public function testPackageMetadataExposesTheDeclaredNullableVersion(): void
    {
        $method = new ReflectionMethod(PackageMetadataInterface::class, 'version');
        self::assertSame('?string', (string) $method->getReturnType());
        self::assertSame([], $method->getParameters());

        $package = $this->createStub(PackageMetadataInterface::class);
        $package->method('version')->willReturn(' custom build ', null);
        self::assertSame(' custom build ', $package->version());
        self::assertNull($package->version());
    }

    public function testDeclaresCompletePackageAndClassGraphOperations(): void
    {
        $contract = new ReflectionClass(PackageManagerInterface::class);

        self::assertTrue($contract->isInterface());
        self::assertSame([
            'all',
            'packages',
            'environmentRequirements',
            'hasEnvironmentRequirements',
            'ofComposerType',
            'get',
            'root',
            'classes',
            'allClasses',
            'packageForClass',
        ], array_map(static fn(ReflectionMethod $method): string => $method->getName(), $contract->getMethods()));
    }

    /** @throws Throwable When fixture setup or the operation under test throws */
    public function testPackageLookupsUseSharedMetadataReturnTypes(): void
    {
        $contract = new ReflectionClass(PackageManagerInterface::class);

        foreach ([
            'get'             => true,
            'root'            => false,
            'packageForClass' => true,
        ] as $methodName => $nullable) {
            $type = $contract->getMethod($methodName)->getReturnType();

            self::assertInstanceOf(ReflectionNamedType::class, $type);
            self::assertSame(PackageMetadataInterface::class, $type->getName());
            self::assertSame($nullable, $type->allowsNull());
        }
    }
}
