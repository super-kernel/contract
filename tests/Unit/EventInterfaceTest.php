<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use SuperKernel\Contract\EventInterface;

final class EventInterfaceTest extends TestCase
{
    public function testDeclaresAMethodlessFrameworkEventMarker(): void
    {
        $contract = new ReflectionClass(EventInterface::class);

        $this->assertTrue($contract->isInterface());
        $this->assertSame([], $contract->getInterfaceNames());
        $this->assertSame([], $contract->getMethods());
    }
}
