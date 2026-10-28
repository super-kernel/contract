<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Psr\Log\LoggerInterface;

/**
 * Identifies the framework PSR-3 log port. The default implementation writes to standard output.
 * Applications may replace its transport, formatting, and minimum level.
 */
interface StdoutLoggerInterface extends LoggerInterface
{
}
