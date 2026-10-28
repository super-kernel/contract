<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Handles one supported native property Attribute through a shared container and assignment context.
 */
interface PropertyAttributeHandlerInterface
{
    /**
     * Creates a handler that resolves shared dependencies from the application container.
     */
    public function __construct(ContainerInterface $container);

    /**
     * Handles one exact native property Attribute. Omitting an assignment leaves the property unchanged.
     */
    public function handle(PropertyContextInterface $context, object $attribute): void;
}
