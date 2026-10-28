<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * Provides PSR-11 lookup for shared, application-lifetime services.
 *
 * Class and interface identifiers resolve only to compatible instances.
 *
 * Ephemeral objects remain the caller's responsibility or belong in a dedicated factory.
 */
interface ContainerInterface extends PsrContainerInterface
{
}
