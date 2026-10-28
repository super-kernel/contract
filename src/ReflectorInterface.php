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
use ReflectionParameter;
use ReflectionProperty;
use ReflectionReference;
use ReflectionZendExtension;
use UnitEnum;

/**
 * Provides reusable access to PHP's native reflection objects.
 */
interface ReflectorInterface
{
    /**
     * Reflects a class-like symbol or object.
     *
     * @template TObject of object
     *
     * @param class-string<TObject>|TObject $class
     *
     * @return ReflectionClass<TObject>
     *
     * @throws ReflectionException When the class-like symbol does not exist or cannot be reflected
     */
    public function reflectClass(object|string $class): ReflectionClass;

    /**
     * Reflects a class constant.
     *
     * @param class-string|object $class
     *
     * @throws ReflectionException When the class-like symbol or constant does not exist
     */
    public function reflectClassConstant(object|string $class, string $constant): ReflectionClassConstant;

    /**
     * Reflects a global constant.
     *
     * @param non-empty-string $name
     *
     * @throws ReflectionException When the global constant does not exist
     */
    public function reflectConstant(string $name): ReflectionConstant;

    /**
     * Reflects an enum.
     *
     * @template TEnum of UnitEnum
     *
     * @param class-string<TEnum>|TEnum $class
     *
     * @return ReflectionEnum<TEnum>
     *
     * @throws ReflectionException When the symbol is not an enum
     */
    public function reflectEnum(UnitEnum|string $class): ReflectionEnum;

    /**
     * Reflects a unit or backed enum case.
     *
     * @param class-string<UnitEnum>|UnitEnum $class
     * @param non-empty-string                $constant
     *
     * @throws ReflectionException When the enum or case does not exist
     */
    public function reflectEnumUnitCase(UnitEnum|string $class, string $constant): ReflectionEnumUnitCase;

    /**
     * Reflects a backed enum case.
     *
     * @param class-string<BackedEnum>|BackedEnum $class
     * @param non-empty-string                    $constant
     *
     * @throws ReflectionException When the enum or backed case does not exist
     */
    public function reflectEnumBackedCase(BackedEnum|string $class, string $constant): ReflectionEnumBackedCase;

    /**
     * Reflects a loaded PHP extension.
     *
     * @param non-empty-string $name
     *
     * @throws ReflectionException When the PHP extension is not loaded
     */
    public function reflectExtension(string $name): ReflectionExtension;

    /**
     * Reflects a loaded Zend extension.
     *
     * @param non-empty-string $name
     *
     * @throws ReflectionException When the Zend extension is not loaded
     */
    public function reflectZendExtension(string $name): ReflectionZendExtension;

    /**
     * Reflects a named function or closure.
     *
     * @param Closure|callable-string $function
     *
     * @throws ReflectionException When the function does not exist
     */
    public function reflectFunction(Closure|string $function): ReflectionFunction;

    /**
     * Reflects a method.
     *
     * @param class-string|object|non-empty-string $objectOrMethod Class-like target, or `Class::method` when method is omitted
     * @param non-empty-string|null                $method         Required when the first argument is an object or class name
     *
     * @throws ReflectionException When the class-like symbol or method does not exist
     */
    public function reflectMethod(object|string $objectOrMethod, ?string $method = null): ReflectionMethod;

    /**
     * Reflects a callable parameter by position or name.
     *
     * @param callable|array{class-string|object, non-empty-string}|string $function  Closure or invokable object,
     *                                                                                function or method name,
     *                                                                                or method pair
     * @param int|non-empty-string                                         $parameter
     *
     * @throws ReflectionException When the callable or parameter does not exist
     */
    public function reflectParameter(callable|array|string $function, int|string $parameter): ReflectionParameter;

    /**
     * Reflects one object instance.
     *
     * @template TObject of object
     *
     * @param TObject $object
     *
     * @return ReflectionObject<TObject>
     */
    public function reflectObject(object $object): ReflectionObject;

    /**
     * Reflects a class property.
     *
     * @param class-string|object $class
     * @param non-empty-string    $property
     *
     * @throws ReflectionException When the class-like symbol or property does not exist
     */
    public function reflectProperty(object|string $class, string $property): ReflectionProperty;

    /**
     * Reflects a running or suspended generator.
     */
    public function reflectGenerator(Generator $generator): ReflectionGenerator;

    /**
     * Reflects a running, suspended, or terminated fiber.
     */
    public function reflectFiber(Fiber $fiber): ReflectionFiber;

    /**
     * Reflects an array reference when the selected element is a reference.
     *
     * @param array<array-key, mixed> $array
     *
     * @return ReflectionReference|null Null when the selected element is not a reference
     *
     * @throws ReflectionException When the selected key does not exist
     */
    public function reflectReference(array $array, int|string $key): ?ReflectionReference;
}
