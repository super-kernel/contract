<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Identifies the package metadata required for runtime workspace ownership.
 */
interface PackageMetadataInterface
{
    /**
     * Returns the lowercase Composer package name.
     *
     * @return string Lowercase Composer package name
     */
    public function name(): string;

    /**
     * Returns the version string exactly as declared in the package manifest or lock record.
     *
     * No inference, normalization, format validation, or comparison is performed.
     *
     * @return string|null Declared string, or null when the root manifest omits the version
     */
    public function version(): ?string;

    /**
     * Returns the package source reference when one is available.
     */
    public function reference(): ?string;

    /**
     * Returns the canonical package directory when the package is located in the represented workspace.
     *
     * @return string|null Canonical package directory, or null when the package is not located
     */
    public function locatedPath(): ?string;
}
