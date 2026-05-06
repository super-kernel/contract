<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

interface ScannerInterface
{
	/**
	 * @param callable(): mixed $task
	 */
	public function execute(callable $task): void;
}
