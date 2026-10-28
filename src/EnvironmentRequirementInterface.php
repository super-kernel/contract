<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Describes one Composer platform requirement supplied by the execution environment.
 */
interface EnvironmentRequirementInterface
{
    /**
     * Returns the lowercase Composer platform package name.
     */
    public function name(): string;

    /**
     * Returns the constraint exactly as represented by the owning Composer metadata source.
     */
    public function constraint(): string;

    /**
     * Returns the lowercase Composer package name that declares the environment requirement.
     */
    public function requiredBy(): string;

    /**
     * Reports whether the root package declared the requirement in `require-dev`.
     *
     * Dependency-package `require-dev` declarations are root-only and are not represented.
     */
    public function isDevRequirement(): bool;
}
