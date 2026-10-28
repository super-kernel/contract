<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

use RuntimeException;

/**
 * Owns a process-local SPL classmap loader and its preload interception chain.
 */
interface AutoLoaderInterface
{
    /**
     * Attempts to load one requested class through the classmap.
     *
     * @param class-string $class Class name requested by SPL
     */
    public function __invoke(string $class): void;

    /**
     * Returns the remaining construction-time mappings by value.
     * Loaded symbols are removed; entries cannot be appended or replaced.
     *
     * @return array<class-string, non-empty-string>
     */
    public function getClassMap(): array;

    /**
     * Adds a preload callback in registration order without changing the SPL stack.
     *
     * Returning true stops later callbacks and the mapped file include.
     *
     * @param callable(class-string, non-empty-string): bool $interceptor Class and mapped file callback
     *
     * @return positive-int Cancellation identifier
     */
    public function addInterceptor(callable $interceptor): int;

    /**
     * Removes an interceptor by its registration identifier.
     */
    public function removeInterceptor(int $interceptorId): bool;

    /**
     * Reports whether this instance is present in the current SPL stack.
     */
    public function isRegistered(): bool;

    /**
     * Removes only this loader after all mappings have loaded.
     *
     * @throws RuntimeException When mappings refer to undeclared symbols or this loader cannot be removed from SPL
     */
    public function unregister(): void;
}
