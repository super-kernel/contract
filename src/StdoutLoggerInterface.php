<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use Psr\Log\LoggerInterface;

/**
 * Describe a standard output logger instance.
 *
 * Provides a specialized logger interface for directing log messages to the standard output stream (STDOUT).
 *
 * See https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md for the full
 * interface specification.
 */
interface StdoutLoggerInterface extends LoggerInterface
{
}
