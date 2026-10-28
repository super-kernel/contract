<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Stringable;

/**
 * Provides the project's base directory as a string across framework components.
 */
interface BasePathInterface extends Stringable
{
    /**
     * Returns the canonical project directory or the phar:// root inside the running application archive.
     *
     * @return non-empty-string
     */
    public function __toString(): string;
}
