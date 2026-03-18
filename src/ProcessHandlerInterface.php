<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use Throwable;

/**
 * Interface ProcessHandlerInterface
 *
 * Defines the contract for a one-off (disposable) process handler.
 * This interface abstracts the logic for executing tasks in separate processes
 * across different environments (e.g., CLI, PCNTL, or specialized runtimes).
 */
interface ProcessHandlerInterface
{
	/**
	 * Determine if the process handler is supported in the current environment.
	 *
	 * Typical implementations check for required extensions (like pcntl or posix)
	 * or the current PHP Server API (SAPI).
	 *
	 * @return bool True if the handler is supported, false otherwise.
	 */
	public function supports(): bool;

	/**
	 * Execute a task within a managed process.
	 *
	 * This method handles the lifecycle of the process, including spawning,
	 * execution of the callback, and resource cleanup.
	 *
	 * @param callable $task The anonymous function or callback to be executed.
	 *
	 * @return void
	 * @throws Throwable If process creation fails or the task encounters an unhandled error.
	 */
	public function execute(callable $task): void;
}