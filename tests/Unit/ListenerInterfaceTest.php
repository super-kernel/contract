<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use SuperKernel\Contract\ListenerInterface;

final class ListenerInterfaceTest extends TestCase
{
    public function testDeclaresTheSharedListenerEventContract(): void
    {
        $contract = new ReflectionClass(ListenerInterface::class);
        $listen = $contract->getMethod('listen');
        $process = $contract->getMethod('process');
        $documentation = $listen->getDocComment();

        self::assertTrue($contract->isInterface());
        self::assertSame([], $contract->getInterfaceNames());
        self::assertCount(2, $contract->getMethods());
        self::assertSame(ListenerInterface::class, $listen->getDeclaringClass()->getName());
        self::assertTrue($listen->isPublic());
        self::assertFalse($listen->isStatic());
        self::assertCount(0, $listen->getParameters());
        self::assertSame('array', (string) $listen->getReturnType());
        self::assertIsString($documentation);
        self::assertStringContainsString('@return list<class-string>', $documentation);
        self::assertSame(ListenerInterface::class, $process->getDeclaringClass()->getName());
        self::assertTrue($process->isPublic());
        self::assertFalse($process->isStatic());
        self::assertCount(1, $process->getParameters());
        self::assertSame('object', (string) $process->getParameters()[0]->getType());
        self::assertSame('void', (string) $process->getReturnType());
    }
}
