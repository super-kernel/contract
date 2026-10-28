<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Exposes collected package annotations without selecting their value implementation or persistence format.
 *
 * Maps retain declaring classes, exact member names, declaration order, and metadata instance identity.
 */
interface PackageAnnotationsInterface
{
    /**
     * Returns the normalized Composer package name owning these annotations.
     *
     * @return non-empty-string
     */
    public function packageName(): string;

    /**
     * Returns the nullable Composer reference captured for this package.
     */
    public function reference(): ?string;

    /**
     * Returns the Attributes declared on each collected class.
     *
     * @return array<class-string, list<AttributeMetadataInterface<object>>>
     */
    public function classAttributes(): array;

    /**
     * Returns declared method Attributes grouped by their owning class and method name.
     *
     * @return array<class-string, array<non-empty-string, list<AttributeMetadataInterface<object>>>>
     */
    public function methodAttributes(): array;

    /**
     * Returns declared property Attributes grouped by their owning class and property name.
     *
     * @return array<class-string, array<non-empty-string, list<AttributeMetadataInterface<object>>>>
     */
    public function propertyAttributes(): array;
}
