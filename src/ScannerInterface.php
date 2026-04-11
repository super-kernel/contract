<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface ScannerInterface
{
	public function execute(callable $task): void;
}
