<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use Exception;

/**
 * @ApplicationInterface
 * @\SuperKernel\Contract\ApplicationInterface
 */
interface ApplicationInterface
{
	/**
	 * Runs the current application.
	 *
	 * @return void
	 * @throws Exception When running fails.
	 */
	public function run(): void;
}