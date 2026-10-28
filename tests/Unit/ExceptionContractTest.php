<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use SuperKernel\Contract\ExceptionDispatcherInterface;
use Throwable;

final class ExceptionContractTest extends TestCase
{
    public function testDeclaresTheSharedExceptionDispatchContract(): void
    {
        $dispatcher = new ReflectionClass(ExceptionDispatcherInterface::class);
        $dispatch = $dispatcher->getMethod('dispatch');

        self::assertTrue($dispatcher->isInterface());
        self::assertSame([], $dispatcher->getInterfaceNames());
        self::assertCount(1, $dispatch->getParameters());
        self::assertSame(Throwable::class, (string) $dispatch->getParameters()[0]->getType());
        self::assertSame('void', (string) $dispatch->getReturnType());
    }
}
