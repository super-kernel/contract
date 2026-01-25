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
 * Describes a complete, unified API for working with PHP reflection objects.
 *
 * This interface defines a centralized registry for accessing reflection instances covering the full reflection
 * surface, including classes, constants, enums, extensions, functions, methods, properties, generators,
 * fibers, and references.
 *
 * Reflectors are resolved on demand and cached internally: if a matching reflection instance already exists, it is
 * returned directly; otherwise, a new instance is created, stored for subsequent access, and returned.
 *
 * Implementations are expected to ensure reflector reuse, minimize redundant instantiation, and provide a consistent
 * access model for reflection-intensive subsystems such as dependency injection, attribute processing, and runtime
 * metadata analysis.
 */
interface ReflectorProviderInterface
{
	/**
	 * Retrieves the reflector associated with the given class name or object, instantiating it on first access.
	 *
	 * @template T of object
	 *
	 * @param class-string<T>|T $class
	 *
	 * @return ReflectionClass<T>
	 */
	public function reflectClass(object|string $class): ReflectionClass;

	/**
	 * Retrieves the class constant reflector for the given class and constant name, instantiating it on first access.
	 *
	 * @param object|class-string $class
	 * @param string              $constant
	 *
	 * @return ReflectionClassConstant
	 */
	public function reflectClassConstant(object|string $class, string $constant): ReflectionClassConstant;

	/**
	 * Retrieves the global constant reflector for the given constant name, instantiating it on first access.
	 *
	 * @param string $name
	 *
	 * @return ReflectionConstant
	 */
	public function reflectConstant(string $name): ReflectionConstant;

	/**
	 * Retrieves the enum reflector for the given enum name, instantiating it on first access.
	 *
	 * @param UnitEnum|class-string $class
	 *
	 * @return ReflectionEnum
	 */
	public function reflectEnum(UnitEnum|string $class): ReflectionEnum;

	/**
	 * Retrieves the enum unit case reflector for the given enum and case name, instantiating it on first access.
	 *
	 * @param UnitEnum|class-string $class
	 * @param string                $constant
	 *
	 * @return ReflectionEnumUnitCase
	 */
	public function reflectEnumUnitCase(UnitEnum|string $class, string $constant): ReflectionEnumUnitCase;

	/**
	 * Retrieves the enum backed case reflector for the given enum and case name, instantiating it on first access.
	 *
	 * @param BackedEnum|class-string $class
	 * @param string                  $constant
	 *
	 * @return ReflectionEnumBackedCase
	 */
	public function reflectEnumBackedCase(BackedEnum|string $class, string $constant): ReflectionEnumBackedCase;

	/**
	 * Retrieves the Zend extension reflector for the given extension name, instantiating it on first access.
	 *
	 * @param string $name
	 *
	 * @return ReflectionZendExtension
	 */
	public function reflectZendExtension(string $name): ReflectionZendExtension;

	/**
	 * Retrieves the extension reflector for the given extension name, instantiating it on first access.
	 *
	 * @param string $name
	 *
	 * @return ReflectionExtension
	 */
	public function reflectExtension(string $name): ReflectionExtension;

	/**
	 * Retrieves the function reflector for the given function name, instantiating it on first access.
	 *
	 * @param Closure|string $function Global or namespaced function name, not a class method.
	 *
	 * @return ReflectionFunction
	 */
	public function reflectFunction(Closure|string $function): ReflectionFunction;

	/**
	 * Retrieves the method reflector for the given class and method name, instantiating it on first access.
	 *
	 * @param object|class-string $class
	 * @param string              $method
	 *
	 * @return ReflectionMethod
	 */
	public function reflectMethod(object|string $class, string $method): ReflectionMethod;

	/**
	 * Retrieves the object reflector for the given runtime object instance, instantiating it on first access.
	 *
	 * @template T of object
	 *
	 * @param T $class
	 *
	 * @return ReflectionObject<T>
	 */
	public function reflectObject(object $class): ReflectionObject;

	/**
	 * Retrieves the property reflector for the given class and property name, instantiating it on first access.
	 *
	 * @param object|class-string $class
	 * @param string              $property
	 *
	 * @return ReflectionProperty
	 */
	public function reflectProperty(object|string $class, string $property): ReflectionProperty;

	/**
	 * Retrieves the generator reflector for the given generator instance, instantiating it on first access.
	 *
	 * @param Generator $generator
	 *
	 * @return ReflectionGenerator
	 */
	public function reflectGenerator(Generator $generator): ReflectionGenerator;

	/**
	 * Retrieves the fiber reflector for the given fiber instance, instantiating it on first access.
	 *
	 * @param Fiber $fiber
	 *
	 * @return ReflectionFiber
	 */
	public function reflectFiber(Fiber $fiber): ReflectionFiber;

	/**
	 * Retrieves the reference reflector for the given array and key, instantiating it on first access,
	 * or returns null if the value is not a reference.
	 *
	 * @param array      $array
	 * @param int|string $key
	 *
	 * @return ReflectionReference|null
	 */
	public function reflectReference(array $array, int|string $key): ?ReflectionReference;
}
