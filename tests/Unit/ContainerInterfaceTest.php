<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use ReflectionClass;
use SuperKernel\Contract\ContainerInterface;

final class ContainerInterfaceTest extends TestCase
{
    public function testExtendsThePsrContainerContract(): void
    {
        $contract = new ReflectionClass(ContainerInterface::class);

        $this->assertTrue($contract->implementsInterface(PsrContainerInterface::class));
    }
}
