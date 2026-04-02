<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use Attribute;

interface AnnotationInterface
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
	 * Attribute declared on all.
	 */
	public const int TARGET_ALL = Attribute::TARGET_ALL;

	/**
	 * Gets the fully qualified class name (FQCN) of the annotation itself.
	 *
	 * @return string The annotation class name.
	 */
	public function getName(): string;

	/**
	 * Gets the instantiated annotation object.
	 *
	 * @return object The annotation instance.
	 */
	public function getInstance(): object;

	/**
	 * Gets the fully qualified class name (FQCN) where this annotation is applied.
	 * * In the case of methods, properties, or constants, this returns the name of the class that contains them.
	 *
	 * @return string The target class name.
	 */
	public function getClass(): string;
}