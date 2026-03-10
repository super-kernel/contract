<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use Attribute;
use LogicException;
use Reflector;

/**
 * Represents a resolved attribute instance together with its declaration metadata.
 *
 * Provides access to the instantiated attribute object and the reflection
 * context describing where the attribute was declared.
 *
 * Consumers should call compatible() to verify that the attribute applies
 * to a specific target type before accessing target-specific metadata.
 */
interface AttributeInterface
{
	/**
	 * Attribute declared on a class.
	 */
	public const int TARGET_CLASS = Attribute::TARGET_CLASS;

	/**
	 * Attribute declared on a class method.
	 */
	public const int TARGET_METHOD = Attribute::TARGET_METHOD;

	/**
	 * Attribute declared on a class property.
	 */
	public const int TARGET_PROPERTY = Attribute::TARGET_PROPERTY;

	/**
	 * Attribute declared on a class constant.
	 */
	public const int TARGET_CLASS_CONSTANT = Attribute::TARGET_CLASS_CONSTANT;

	/**
	 * Attribute declared on a function.
	 */
	public const int TARGET_FUNCTION = Attribute::TARGET_FUNCTION;

	/**
	 * Attribute declared on a parameter.
	 */
	public const int TARGET_PARAMETER = Attribute::TARGET_PARAMETER;

	/**
	 * Returns the fully-qualified class name of the attribute.
	 *
	 * @return class-string
	 */
	public function getAttribute(): string;

	/**
	 * Returns the instantiated attribute object.
	 *
	 * Implementations may lazily instantiate the attribute instance
	 * on first access.
	 *
	 * @return object
	 */
	public function getInstance(): object;

	/**
	 * Returns the declaration target type of the attribute.
	 *
	 * @return int Bitmask composed of TARGET_* constants.
	 */
	public function getTarget(): int;

	/**
	 * Determines whether the attribute is compatible with the specified target type.
	 *
	 * @param int $type Bitmask composed of TARGET_* constants.
	 */
	public function compatible(int $type): bool;

	/**
	 * Returns the reflector representing the declaration context.
	 *
	 * @return Reflector
	 */
	public function getReflector(): Reflector;

	/**
	 * Returns the class name in which the attribute is declared.
	 *
	 * This is valid for class-level attributes, class members,
	 * and method parameters.
	 *
	 * @return class-string
	 *
	 * @throws LogicException If the attribute is not associated with a class context.
	 */
	public function getClass(): string;

	/**
	 * Returns the method name on which the attribute is declared.
	 *
	 * @return non-empty-string
	 *
	 * @throws LogicException If the attribute is not declared on a method.
	 */
	public function getMethod(): string;

	/**
	 * Returns the function name on which the attribute is declared.
	 *
	 * @return non-empty-string
	 *
	 * @throws LogicException If the attribute is not declared on a function.
	 */
	public function getFunction(): string;

	/**
	 * Returns the property name on which the attribute is declared.
	 *
	 * @return non-empty-string
	 *
	 * @throws LogicException If the attribute is not declared on a property.
	 */
	public function getProperty(): string;

	/**
	 * Returns the class constant name on which the attribute is declared.
	 *
	 * @return non-empty-string
	 *
	 * @throws LogicException If the attribute is not declared on a class constant.
	 */
	public function getClassConstant(): string;

	/**
	 * Returns the zero-based index of the parameter on which the attribute is declared.
	 *
	 * @throws LogicException If the attribute is not declared on a parameter.
	 */
	public function getParameterIndex(): int;
}