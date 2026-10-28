<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use SuperKernel\Contract\AnnotationCollectorInterface;
use SuperKernel\Contract\PackageAnnotationsInterface;
use SuperKernel\Contract\ScanDiagnosticsInterface;

final class ScanDiagnosticsInterfaceTest extends TestCase
{
    public function testDiagnosticsAreAnIndependentReadCapability(): void
    {
        $reflection = new ReflectionClass(ScanDiagnosticsInterface::class);
        self::assertTrue($reflection->isInterface());
        self::assertSame([], $reflection->getInterfaceNames());
        self::assertCount(1, $reflection->getMethods());
        $method = $reflection->getMethod('getDiagnostics');
        self::assertSame([], $method->getParameters());
        self::assertSame('array', (string) $method->getReturnType());
        self::assertCount(9, new ReflectionClass(AnnotationCollectorInterface::class)->getMethods());
        self::assertCount(5, new ReflectionClass(PackageAnnotationsInterface::class)->getMethods());
    }
}
