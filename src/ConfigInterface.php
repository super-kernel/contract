<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface ConfigInterface
{
	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string|null $key     identifier of the entry to look for.
	 * @param mixed       $default default value of the entry when does not found.
	 *
	 * @return mixed entry
	 */
	public function get(?string $key = null, mixed $default = null): mixed;

	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * @param string $key
	 *
	 * @return bool
	 */
	public function has(string $key): bool;

	/**
	 * Set a value to the container by its identifier.
	 *
	 * @param string $key identifier of the entry to set
	 * @param mixed  $value the value that save to container
	 *
	 * @return void
	 */
	public function set(string $key, mixed $value): void;
}