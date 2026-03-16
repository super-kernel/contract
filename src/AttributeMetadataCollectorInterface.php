<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Provides a unified interface for querying collected PHP attributes.
 *
 * Implementations index attributes declared on classes, methods, properties, functions, and parameters and expose them
 * through a consistent lookup API.
 *
 * Attribute classes may be repeatable. All query methods therefore return a list of AttributeMetadataInterface
 * instances.
 */
interface AttributeMetadataCollectorInterface
{
	/**
	 * Returns attributes declared on the specified class.
	 *
	 * @param class-string $class
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getClassAttributes(string $class): array;

	/**
	 * Returns attributes declared on the specified class method.
	 *
	 * @param class-string     $class
	 * @param non-empty-string $method
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getMethodAttributes(string $class, string $method): array;

	/**
	 * Returns attributes declared on the specified class property.
	 *
	 * @param class-string     $class
	 * @param non-empty-string $property
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getPropertyAttributes(string $class, string $property): array;

	/**
	 * Returns class attributes matching the specified attribute class.
	 *
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getClassesByAttribute(string $attribute): array;

	/**
	 * Returns method attributes matching the specified attribute class.
	 *
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getMethodsByAttribute(string $attribute): array;

	/**
	 * Returns property attributes matching the specified attribute class.
	 *
	 * @param class-string $attribute
	 *
	 * @return list<AttributeMetadataInterface>
	 */
	public function getPropertiesByAttribute(string $attribute): array;
}