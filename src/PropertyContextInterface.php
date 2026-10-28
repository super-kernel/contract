<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use LogicException;
use ReflectionProperty;

/**
 * Describes one reflected property and records at most one assignment produced by its Attribute handlers.
 */
interface PropertyContextInterface
{
    /**
     * Returns the class that declares or inherits the property being processed.
     *
     * @return class-string
     */
    public function className(): string;

    /**
     * Returns the reflected property being processed.
     */
    public function property(): ReflectionProperty;

    /**
     * Reports whether an Attribute handler has supplied an assignment.
     */
    public function hasAssignment(): bool;

    /**
     * Returns the assignment supplied by an Attribute handler.
     *
     * @throws LogicException when no assignment has been supplied
     */
    public function assignment(): mixed;

    /**
     * Supplies the single assignment that will be applied to the property.
     *
     * @throws LogicException when an assignment has already been supplied
     */
    public function assign(mixed $value): void;
}
