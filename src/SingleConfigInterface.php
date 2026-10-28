<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Marks a typed configuration object that is itself the single default configuration item.
 * Component configuration contracts extend this interface and declare their domain-specific getters.
 */
interface SingleConfigInterface
{
}
