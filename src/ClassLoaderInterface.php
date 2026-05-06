<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Provides class paths from an explicit class map and can register itself with the SPL autoload stack.
 */
interface ClassLoaderInterface
{
	/**
	 * @return array<class-string, non-empty-string> Class names mapped to absolute PHP file paths.
	 */
	public function getClassMap(): array;

	/**
	 * Returns the mapped PHP file path for the given class name.
	 *
	 * @param class-string $class
	 *
	 * @return non-empty-string|null
	 */
	public function getClassPath(string $class): ?string;

	/**
	 * Registers the loader in the SPL autoload stack.
	 *
	 * @param bool $prepend If true, `spl_autoload_register()` will prepend the autoloader on the autoload queue instead
	 *                      of appending it.
	 */
	public function register(bool $prepend = false): void;

	/**
	 * Unregisters the loader from the SPL autoload stack.
	 */
	public function unregister(): void;
}
