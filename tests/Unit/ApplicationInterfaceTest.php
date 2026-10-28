<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use SuperKernel\Contract\ApplicationInterface;

use function array_map;

final class ApplicationInterfaceTest extends TestCase
{
    public function testDeclaresTheApplicationRuntimeContract(): void
    {
        $contract = new ReflectionClass(ApplicationInterface::class);
        $run = $contract->getMethod('run');

        $this->assertTrue($contract->isInterface());
        $this->assertSame([], $contract->getInterfaceNames());
        $this->assertSame([
            'run',
        ], array_map(static fn(ReflectionMethod $method): string => $method->getName(), $contract->getMethods()));
        $this->assertSame(0, $run->getNumberOfParameters());
        $this->assertSame('int', (string) $run->getReturnType());
    }
}
