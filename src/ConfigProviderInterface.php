<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * @ConfigProviderInterface
 * @\SuperKernel\Contract\ConfigProviderInterface
 */
interface ConfigProviderInterface
{
    public function __invoke(): array;
}