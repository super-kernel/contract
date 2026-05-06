<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Attribute;

/**
 * Describes one PHP attribute instance collected from a class-like target.
 */
interface AttributeMetadataInterface
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
	 * Attribute declared on a method parameter.
	 */
	public const int TARGET_PARAMETER = Attribute::TARGET_PARAMETER;

	/**
	 * Attribute declared on any supported target.
	 */
	public const int TARGET_ALL = self::TARGET_CLASS
		| self::TARGET_METHOD
		| self::TARGET_PROPERTY
		| self::TARGET_CLASS_CONSTANT
		| self::TARGET_PARAMETER;

	/**
	 * @return class-string Attribute class name.
	 */
	public function getAttributeName(): string;

	/**
	 * @return object Instantiated attribute object.
	 */
	public function getInstance(): object;

	/**
	 * @return self::TARGET_CLASS|self::TARGET_METHOD|self::TARGET_PROPERTY|self::TARGET_CLASS_CONSTANT|self::TARGET_PARAMETER
	 */
	public function getTarget(): int;

	/**
	 * @return class-string Class that declares the attribute target.
	 */
	public function getDeclaringClass(): string;

	/**
	 * Returns the method, property, or class constant name for member targets.
	 *
	 * Parameter attributes return the declaring method name here.
	 *
	 * @return non-empty-string|null
	 */
	public function getMemberName(): ?string;

	/**
	 * Returns the parameter name for method parameter targets.
	 *
	 * @return non-empty-string|null
	 */
	public function getParameterName(): ?string;

	/**
	 * Checks whether this metadata belongs to the specified PHP attribute target mask.
	 *
	 * @param int $target Attribute target mask.
	 */
	public function isTarget(int $target): bool;
}
