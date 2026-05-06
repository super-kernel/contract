<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Exposes collected PHP attributes through target-oriented and attribute-oriented lookups.
 */
interface AttributeCollectorInterface
{
	/**
	 * @param class-string $class
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getClassAttributes(string $class): array;

	/**
	 * @param class-string      $class
	 * @param non-empty-string $method
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getMethodAttributes(string $class, string $method): array;

	/**
	 * @param class-string      $class
	 * @param non-empty-string $property
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getPropertyAttributes(string $class, string $property): array;

	/**
	 * @param class-string      $class
	 * @param non-empty-string $constant
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getClassConstantAttributes(string $class, string $constant): array;

	/**
	 * @param class-string      $class
	 * @param non-empty-string $method
	 * @param non-empty-string $parameter
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getParameterAttributes(string $class, string $method, string $parameter): array;

	/**
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function findClassAttributes(string $attribute): array;

	/**
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function findMethodAttributes(string $attribute): array;

	/**
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function findPropertyAttributes(string $attribute): array;

	/**
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function findClassConstantAttributes(string $attribute): array;

	/**
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function findParameterAttributes(string $attribute): array;

	/**
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function findAttributes(string $attribute): array;
}
