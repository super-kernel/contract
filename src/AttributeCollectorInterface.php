<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface AttributeCollectorInterface
{
	public const int EXACT_MATCH = 0;

	public const int IS_INSTANCEOF = 2;

	/**
	 * Returns attribute instances matching the given attribute class name.
	 *
	 * @param string                                      $name  Fully qualified class name of the attribute to match.
	 *
	 * @param int<self::EXACT_MATCH, self::IS_INSTANCEOF> $flags Controls how the attribute class name is matched.
	 *                                                           The matching behavior is determined by the flags:
	 *
	 *        - `AttributeCollectorInterface::EXACT_MATCH` (default): Only attributes whose class name
	 *          exactly matches the provided class name (`$name`) will be returned.
	 *
	 *        - `AttributeCollectorInterface::IS_INSTANCEOF`: Attributes whose class is an instance of the
	 *          provided class name (`$name`) will be returned. This allows for matching subclasses or implementing
	 *          classes.
	 *
	 * @return array A list of instantiated attribute objects matching the given criteria.
	 */
	public function getAttribute(string $name, int $flags = AttributeCollectorInterface::EXACT_MATCH): array;

	public function getAttributes(): array;
}