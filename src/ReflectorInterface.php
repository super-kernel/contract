<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

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
use ReflectionParameter;
use ReflectionProperty;
use ReflectionReference;
use ReflectionZendExtension;

/**
 * Describes a complete, unified API for working with PHP reflection objects.
 *
 * This interface defines a centralized registry for accessing reflection instances covering the full reflection
 * surface, including classes, constants, enums, extensions, functions, methods, parameters, properties, generators,
 * fibers, and references.
 *
 * Reflectors are resolved on demand and cached internally: if a matching reflection instance already exists, it is
 * returned directly; otherwise, a new instance is created, stored for subsequent access, and returned.
 *
 * Note: certain parts of the internal reflection API lack the necessary implementation details required to
 * interoperate fully with the reflection extension. As a result, some reflectors may provide limited functionality
 * depending on the underlying PHP runtime capabilities.
 *
 * Implementations are expected to ensure reflector reuse, minimize redundant instantiation, and provide a consistent
 * access model for reflection-intensive subsystems such as dependency injection, attribute processing, and runtime
 * metadata analysis.
 */
interface ReflectorInterface
{
	/**
	 * Retrieves the reflector associated with the given class name, instantiating it on first
	 * access.
	 *
	 * @param string $class
	 *
	 * @return ReflectionClass
	 */
	public function reflectClass(string $class): ReflectionClass;

	/**
	 * Retrieves the class constant reflector for the given class and constant name, instantiating it on first access.
	 *
	 * @param string $class
	 * @param string $constant
	 *
	 * @return ReflectionClassConstant
	 */
	public function reflectClassConstant(string $class, string $constant): ReflectionClassConstant;

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
	 * @param string $class
	 *
	 * @return ReflectionEnum
	 */
	public function reflectEnum(string $class): ReflectionEnum;

	/**
	 * Retrieves the enum unit case reflector for the given enum and case name, instantiating it on first access.
	 *
	 * @param string $class
	 * @param string $constant
	 *
	 * @return ReflectionEnumUnitCase
	 */
	public function reflectEnumUnitCase(string $class, string $constant): ReflectionEnumUnitCase;

	/**
	 * Retrieves the enum backed case reflector for the given enum and case name, instantiating it on first access.
	 *
	 * @param string $class
	 * @param string $constant
	 *
	 * @return ReflectionEnumBackedCase
	 */
	public function reflectEnumBackedCase(string $class, string $constant): ReflectionEnumBackedCase;

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
	 * @param Closure|string $function
	 *
	 * @return ReflectionFunction
	 */
	public function reflectFunction(Closure|string $function): ReflectionFunction;

	/**
	 * Retrieves the method reflector for the given class and method name, instantiating it on first access.
	 *
	 * @param string $class
	 * @param string $method
	 *
	 * @return ReflectionMethod
	 */
	public function reflectMethod(string $class, string $method): ReflectionMethod;

	/**
	 * Retrieves the object reflector for the given class and method, instantiating it on first access.
	 *
	 * @param string $class
	 * @param string $method
	 *
	 * @return ReflectionObject
	 */
	public function reflectObject(string $class, string $method): ReflectionObject;

	/**
	 * Retrieves the method parameter reflector for the given class, method, and parameter name or position,
	 * instantiating it on first access.
	 *
	 * @param string     $class
	 * @param string     $method
	 * @param int|string $param
	 *
	 * @return ReflectionParameter
	 */
	public function reflectMethodParameter(string $class, string $method, int|string $param): ReflectionParameter;

	/**
	 * Retrieves the function parameter reflector for the given function and parameter name or position, instantiating
	 * it on first access.
	 *
	 * @param string     $function
	 * @param int|string $param
	 *
	 * @return ReflectionParameter
	 */
	public function reflectFunctionParameter(string $function, int|string $param): ReflectionParameter;

	/**
	 * Retrieves the property reflector for the given class and property name, instantiating it on first access.
	 *
	 * @param string $class
	 * @param string $property
	 *
	 * @return ReflectionProperty
	 */
	public function reflectProperty(string $class, string $property): ReflectionProperty;

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
	 * Retrieves the reference reflector for the given array and key, instantiating it on first access, or returns null
	 * if the value is not a reference.
	 *
	 * @param array      $array
	 * @param int|string $key
	 *
	 * @return ReflectionReference|null
	 */
	public function reflectReference(array $array, int|string $key): ?ReflectionReference;
}