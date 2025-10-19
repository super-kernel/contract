<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface AttributeCollectorInterface
{
	/**
	 * Finds all Attributes by class name and returns them.
	 *
	 * @param string $attributeName
	 *
	 * @return array<string, object>
	 */
	public function getAttributes(string $attributeName): array;

	/**
	 * For a given entry, find and return its mapped real entry.
	 *
	 * @param string $id
	 *
	 * @return string
	 */
	public function getRealEntry(string $id): string;
}