<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use BackedEnum;
use Closure;
use Fiber;
use Generator;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionConstant;
use ReflectionEnum;
use ReflectionEnumBackedCase;
use ReflectionEnumUnitCase;
use ReflectionException;
use ReflectionExtension;
use ReflectionFiber;
use ReflectionFunction;
use ReflectionGenerator;
use ReflectionMethod;
use ReflectionObject;
use ReflectionProperty;
use ReflectionReference;
use ReflectionZendExtension;
use UnitEnum;

/**
 * Describes the interface of a reflection collector that exposes methods to encapsulate and reuse reflection
 * capabilities.
 */
interface ReflectionCollectorInterface
{
	/**
	 * Resolves a ReflectionClass for the given class name or object instance.
	 *
	 * @template T of object
	 * @param class-string<T>|T $class
	 *
	 * @return ReflectionClass<T>
	 * @throws ReflectionException If the class name is not found or cannot be loaded.
	 */
	public function reflectClass(object|string $class): ReflectionClass;

	/**
	 * Resolves a ReflectionClassConstant for a specific class constant.
	 *
	 * @param object|class-string $class
	 * @param string              $constant
	 *
	 * @return ReflectionClassConstant
	 * @throws ReflectionException If the class does not exist or the constant is undefined.
	 */
	public function reflectClassConstant(object|string $class, string $constant): ReflectionClassConstant;

	/**
	 * Resolves a ReflectionConstant for a global constant.
	 *
	 * @param string $name
	 *
	 * @return ReflectionConstant
	 * @throws ReflectionException If the specified global constant is not defined.
	 */
	public function reflectConstant(string $name): ReflectionConstant;

	/**
	 * Resolves a ReflectionEnum for the specified Enum.
	 *
	 * @template T of UnitEnum
	 * @param T|class-string<T> $class
	 *
	 * @return ReflectionEnum
	 * @throws ReflectionException If the provided name is not a valid Enum.
	 */
	public function reflectEnum(UnitEnum|string $class): ReflectionEnum;

	/**
	 * Resolves a ReflectionEnumUnitCase for an Enum case.
	 *
	 * @param UnitEnum|class-string<UnitEnum> $class
	 * @param string                          $constant
	 *
	 * @return ReflectionEnumUnitCase
	 * @throws ReflectionException If the enum name is invalid or the case does not exist.
	 */
	public function reflectEnumUnitCase(UnitEnum|string $class, string $constant): ReflectionEnumUnitCase;

	/**
	 * Resolves a ReflectionEnumBackedCase for a Backed Enum case.
	 *
	 * @param BackedEnum|class-string<BackedEnum> $class
	 * @param string                              $constant
	 *
	 * @return ReflectionEnumBackedCase
	 * @throws ReflectionException If the enum is not a BackedEnum or the case is undefined.
	 */
	public function reflectEnumBackedCase(BackedEnum|string $class, string $constant): ReflectionEnumBackedCase;

	/**
	 * Resolves a ReflectionZendExtension by name.
	 *
	 * @param string $name
	 *
	 * @return ReflectionZendExtension
	 * @throws ReflectionException If the specified Zend extension is not loaded.
	 */
	public function reflectZendExtension(string $name): ReflectionZendExtension;

	/**
	 * Resolves a ReflectionExtension by name.
	 *
	 * @param string $name
	 *
	 * @return ReflectionExtension
	 * @throws ReflectionException If the specified PHP extension is not loaded.
	 */
	public function reflectExtension(string $name): ReflectionExtension;

	/**
	 * Resolves a ReflectionFunction for a closure or a global function.
	 *
	 * @param Closure|callable-string $function
	 *
	 * @return ReflectionFunction
	 * @throws ReflectionException If the function name is invalid or the function does not exist.
	 */
	public function reflectFunction(Closure|string $function): ReflectionFunction;

	/**
	 * Resolves a ReflectionMethod for a class method.
	 *
	 * @param object|class-string $class
	 * @param string              $method
	 *
	 * @return ReflectionMethod
	 * @throws ReflectionException If the method does not exist in the specified class or object instance.
	 */
	public function reflectMethod(object|string $class, string $method): ReflectionMethod;

	/**
	 * Resolves a ReflectionObject for a specific runtime instance.
	 *
	 * @template T of object
	 * @param object $class
	 *
	 * @return ReflectionObject<T> If the provided argument is not a valid object instance.
	 */
	public function reflectObject(object $class): ReflectionObject;

	/**
	 * Resolves a ReflectionProperty for a class property.
	 *
	 * @param object|class-string $class
	 * @param string              $property
	 *
	 * @return ReflectionProperty
	 * @throws ReflectionException If the property does not exist in the class or is otherwise inaccessible.
	 */
	public function reflectProperty(object|string $class, string $property): ReflectionProperty;

	/**
	 * Resolves a ReflectionGenerator for the given generator.
	 *
	 * @param Generator $generator
	 *
	 * @return ReflectionGenerator
	 */
	public function reflectGenerator(Generator $generator): ReflectionGenerator;

	/**
	 * Resolves a ReflectionFiber for the given fiber.
	 *
	 * @param Fiber $fiber
	 *
	 * @return ReflectionFiber
	 */
	public function reflectFiber(Fiber $fiber): ReflectionFiber;

	/**
	 * Resolves a ReflectionReference for an array element if it is a reference.
	 *
	 * @param array      $array
	 * @param int|string $key
	 *
	 * @return ReflectionReference|null Returns null if the specified key is not a reference.
	 */
	public function reflectReference(array $array, int|string $key): ?ReflectionReference;
}
