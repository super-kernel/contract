<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Provides one deterministic view of root and locked packages, environment requirements, and discovered classes.
 */
interface PackageManagerInterface
{
    /**
     * Returns the root package first, followed by lock-file packages sorted by normalized name.
     *
     * @return list<PackageMetadataInterface>
     */
    public function all(): array;

    /**
     * Returns lock-file packages sorted by normalized name, excluding the root package.
     *
     * @return list<PackageMetadataInterface>
     */
    public function packages(): array;

    /**
     * Returns environment requirements from the root and every lock-file package.
     *
     * @return list<EnvironmentRequirementInterface> Requirements sorted by platform package name and declaring package
     */
    public function environmentRequirements(): array;

    /**
     * Reports whether environmentRequirements() is non-empty.
     */
    public function hasEnvironmentRequirements(): bool;

    /**
     * Selects root and lock-file packages with an exact declared Composer type value.
     *
     * @return list<PackageMetadataInterface> Matching packages in the same deterministic order as all()
     */
    public function ofComposerType(string $composerType): array;

    /**
     * Finds the root or a lock-file package by case-insensitive name, returning null when unknown.
     */
    public function get(string $name): ?PackageMetadataInterface;

    /**
     * Returns the project represented by the root Composer manifest.
     */
    public function root(): PackageMetadataInterface;

    /**
     * Returns every class-like symbol and absolute load path discovered for one package.
     *
     * @param string $packageName Case-insensitive Composer package name
     *
     * @return array<class-string, non-empty-string>|null Sorted class map, or null when the package is unknown
     */
    public function classes(string $packageName): ?array;

    /**
     * Returns every discovered class-like symbol, using all() order to resolve duplicate ownership.
     *
     * @return array<class-string, non-empty-string> Sorted aggregate class map
     */
    public function allClasses(): array;

    /**
     * Finds the package that owns an exact class-like symbol in this manager's class graph.
     *
     * @param class-string $class
     */
    public function packageForClass(string $class): ?PackageMetadataInterface;
}
