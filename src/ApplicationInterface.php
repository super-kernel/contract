<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Represents the runnable application entry point.
 */
interface ApplicationInterface
{
	/**
	 * Boots and runs the application.
	 *
	 * Implementations may expose optional framework-specific arguments.
	 */
	public function run(): int;
}
