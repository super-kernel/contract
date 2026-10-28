<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Stringable;

/**
 * Provides the project's Composer dependency directory as a string across framework components.
 */
interface VendorDirInterface extends Stringable
{
    /**
     * Returns the normalized absolute vendor path, canonicalized when present, including paths inside Phar archives.
     * The directory does not need to exist.
     *
     * @return non-empty-string
     */
    public function __toString(): string;
}
