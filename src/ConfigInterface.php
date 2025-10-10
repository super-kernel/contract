<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface ConfigInterface
{
	/**
	 * Finds an entry that implements the given interface and returns it.
	 *
	 * @param string $interface
	 *
	 * @return mixed entry
	 */
	public function get(string $interface): object;

	/**
	 * Returns true if the given interface can return entries for its implementing classes, false otherwise.
	 *
	 * @param string $interface
	 *
	 * @return bool
	 */
	public function has(string $interface): bool;
}