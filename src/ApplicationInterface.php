<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * @ApplicationInterface
 * @\SuperKernel\Contract\ApplicationInterface
 */
interface ApplicationInterface
{
	/**
	 * Runs the current application.
	 *
	 * @return void Throws \Exception when running fails.
	 */
	public function run(): void;
}