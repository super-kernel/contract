<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Throwable;

/**
 * Dispatches a throwable through the framework's exception-handler chain.
 */
interface ExceptionDispatcherInterface
{
    /**
     * Dispatches matching handlers and completes fallback reporting when none handle the throwable successfully.
     */
    public function dispatch(Throwable $throwable): void;
}
