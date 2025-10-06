<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

/**
 * Describes the interface for a reflector, which exposes methods for reading information about the reflected classes
 * its collects.
 */
interface ReflectionManagerInterface
{
	/**
	 * Finds a reflector by class name and returns it.
	 *
	 * @param string $class
	 *
	 * @return ReflectionClass
	 */
	public function reflectClass(string $class): ReflectionClass;

	/**
	 * Finds a class reflector by class and method name and returns it.
	 *
	 * @param string $classname
	 * @param string $methodName
	 *
	 * @return ReflectionMethod
	 */
	public function reflectMethod(string $classname, string $methodName): ReflectionMethod;

	/**
	 * Finds a method reflector by class and property name and returns it.
	 *
	 * @param string $classname
	 * @param string $propertyName
	 *
	 * @return ReflectionProperty
	 */
	public function reflectProperty(string $classname, string $propertyName): ReflectionProperty;

	/**
	 * Finds all annotations by class name and returns them.
	 *
	 * @param string $name
	 *
	 * @return array<string>
	 */
	public function getAttributes(string $name): array;

	/**
	 * Finds a reflector by class name and returns all annotation reflectors for the given annotation class name.
	 *
	 * @param string      $classname
	 * @param string|null $attributeName
	 *
	 * @return array<ReflectionAttribute>
	 */
	public function getClassAnnotations(string $classname, ?string $attributeName = null): array;
}