<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Interface TaskExecutorInterface
 *
 * Defines a contract for executing a task in a way that ensures the main environment remains untouched.
 *
 * This is primarily used to prevent "environment pollution." For example:
 * - Preventing new classes from being loaded into the main process, which could break subsequent AOP or proxying.
 * - Ensuring static state or global constants defined during the task do not persist.
 *
 * In "Pre-baked" environments like Phar, the implementation may skip the actual execution if the task's results are
 * already considered valid and safe to use, as the primary goal of environment protection is already met.
 */
interface TaskExecutorInterface
{
	/**
	 * Execute the given task.
	 *
	 * The implementation must ensure that any side effects produced by the task (class loading, state changes, etc.)
	 * do not affect the caller's current environment.
	 *
	 * @param callable $task The logic to be executed.
	 *
	 * @return void
	 */
	public function execute(callable $task): void;

}