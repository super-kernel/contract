<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * Framework container contract.
 *
 * Containers are responsible for shared application services. Ephemeral objects should be created by the caller or by
 * dedicated factories.
 */
interface ContainerInterface extends PsrContainerInterface
{
}
