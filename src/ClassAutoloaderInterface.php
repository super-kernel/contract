<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use RuntimeException;

/**
 * High-performance Static Class Autoloader for SuperKernel.
 *
 * This loader provides a mandatory, high-speed lookup mechanism using a pre-defined class map.
 * It is designed for production environments to bypass expensive PSR-4 filesystem checks by providing O(1) resolution
 * for core framework components.
 */
interface ClassAutoloaderInterface
{
	/**
	 * Merges an additional map into the existing class map registry.
	 *
	 * @param array<string, string> $classMap An associative array of FQCNs to absolute file paths.
	 *
	 * @return void
	 */
	public function addClassMap(array $classMap): void;

	/**
	 * Registers this instance as an autoloader in the SPL stack.
	 *
	 * This method enforces a mandatory prepend behavior. The loader is ALWAYS placed
	 * at the top of the SPL stack to ensure maximum performance by intercepting class
	 * resolution before any other registered loaders.
	 *
	 * @return void
	 * @throws RuntimeException If the autoloader cannot be registered.
	 */
	public function register(): void;

	/**
	 * Unregisters this instance from the SPL autoloader stack.
	 *
	 * @return void
	 */
	public function unregister(): void;
}