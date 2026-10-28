<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Exposes package-aware native PHP Attribute metadata collected for the application.
 *
 * Method discovery keeps the first package owning each class before filtering. Repeatable declarations retain
 * collection order and trusted instance identity. Queries neither load nor reflect annotated classes.
 */
interface AnnotationCollectorInterface
{
    /**
     * Returns all collected package annotations keyed by normalized Composer package name.
     *
     * @return array<string, PackageAnnotationsInterface>
     */
    public function getPackages(): array;

    /**
     * Returns the annotations collected for a normalized Composer package name.
     */
    public function getPackage(string $packageName): ?PackageAnnotationsInterface;

    /**
     * Returns classes carrying the exact Attribute class, with only trusted instances of that class retained.
     *
     * @template T of object
     *
     * @param class-string<T> $attribute
     *
     * @return array<class-string, non-empty-list<AttributeMetadataInterface<T>>>
     */
    public function getClassesWithAttribute(string $attribute): array;

    /**
     * Returns classes carrying the named Attribute or one of its derived Attribute types.
     *
     * Matching uses type relationships captured during isolated scanning and retains each trusted concrete Attribute
     * instance assignable to the requested type.
     *
     * @template T of object
     *
     * @param class-string<T> $attribute
     *
     * @return array<class-string, non-empty-list<AttributeMetadataInterface<T>>>
     */
    public function getClassesWithAttributeAssignableTo(string $attribute): array;

    /**
     * Returns the Attributes declared on the named class.
     *
     * @param class-string $class
     *
     * @return list<AttributeMetadataInterface<object>>
     */
    public function getClassAttributes(string $class): array;

    /**
     * Returns the Attributes declared on the named method of a class.
     *
     * @param class-string     $class
     * @param non-empty-string $method
     *
     * @return list<AttributeMetadataInterface<object>>
     */
    public function getMethodAttributes(string $class, string $method): array;

    /**
     * Returns the Attributes declared on the named property of a class.
     *
     * @param class-string     $class
     * @param non-empty-string $property
     *
     * @return list<AttributeMetadataInterface<object>>
     */
    public function getPropertyAttributes(string $class, string $property): array;

    /**
     * Returns methods carrying the exact Attribute class, retaining only trusted instances of that class.
     *
     * @template T of object
     *
     * @param class-string<T> $attribute
     *
     * @return array<class-string, array<non-empty-string, non-empty-list<AttributeMetadataInterface<T>>>>
     */
    public function getMethodsWithAttribute(string $attribute): array;

    /**
     * Returns methods carrying an Attribute assignable to the requested class or interface.
     *
     * Matching uses type relationships captured during scanning and retains compatible trusted concrete instances.
     *
     * @template T of object
     *
     * @param class-string<T> $attribute
     *
     * @return array<class-string, array<non-empty-string, non-empty-list<AttributeMetadataInterface<T>>>>
     */
    public function getMethodsWithAttributeAssignableTo(string $attribute): array;
}
