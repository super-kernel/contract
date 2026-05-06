<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Psr\Log\LoggerInterface;

/**
 * Logger contract for messages written to STDOUT.
 */
interface StdoutLoggerInterface extends LoggerInterface
{
}
