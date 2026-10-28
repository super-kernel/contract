<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use SuperKernel\Contract\StdoutLoggerInterface;

final class StdoutLoggerInterfaceTest extends TestCase
{
    public function testDefinesTheNamedPsrLoggerBoundary(): void
    {
        $contract = new ReflectionClass(StdoutLoggerInterface::class);

        self::assertTrue($contract->isInterface());
        self::assertSame([
            LoggerInterface::class,
        ], $contract->getInterfaceNames());

        foreach ($contract->getMethods() as $method) {
            self::assertSame(LoggerInterface::class, $method->getDeclaringClass()->getName());
        }
    }
}
