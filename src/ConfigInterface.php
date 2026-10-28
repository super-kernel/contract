<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use Psr\Container\ContainerExceptionInterface;

/**
 * Provides declaration checks and lazy access to typed configuration items.
 */
interface ConfigInterface
{
    /**
     * Returns whether an item is declared for the exact contract, without resolving its source or method.
     * A null name checks the source declaration, including sources without a default among multiple items.
     * Single sources expose the name "default".
     *
     * @param class-string $interface
     */
    public function has(string $interface, ?string $name = null): bool;

    /**
     * Returns the retained item for the exact contract and name, loading it on the first successful lookup.
     * A null name selects the declared default. Single sources expose themselves as the "default" item.
     * Multiple sources expose attributed methods by method name. A sole item is automatically the default.
     * With several items, a null name requires an explicitly marked default and otherwise raises a loading error.
     * Returns null without resolving a source when the contract or item is undeclared.
     * The returned object implements the requested contract. Failed loads may be retried by a later lookup.
     *
     * @template T of object
     *
     * @param class-string<T> $interface
     *
     * @return T|null
     *
     * @throws ContainerExceptionInterface when loading or declared source-type validation fails
     */
    public function get(string $interface, ?string $name = null): ?object;
}
