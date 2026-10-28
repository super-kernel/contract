<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Identifies the application selected for the current framework runtime.
 */
interface ApplicationInterface
{
    /**
     * Runs the application and returns its process status.
     */
    public function run(): int;
}
