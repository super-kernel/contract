<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Exposes a trusted native Attribute instance and its captured type relationships without prescribing storage.
 *
 * @template-covariant T of object
 */
interface AttributeMetadataInterface
{
    /**
     * Returns the concrete class of the retained Attribute instance.
     *
     * @return class-string<T>
     */
    public function name(): string;

    /**
     * Returns the retained instance without reconstructing it or repeating Attribute validation.
     *
     * @return T
     */
    public function attribute(): object;

    /**
     * Returns the concrete type first, followed by unique assignable types captured during collection.
     *
     * @return non-empty-list<class-string>
     */
    public function types(): array;
}
