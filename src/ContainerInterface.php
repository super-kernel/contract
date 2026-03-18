<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Containers only manage long-lived objects, and short-lived objects are managed by the
 * caller {@see https://www.php-fig.org/psr/psr-11/}.
 */
interface ContainerInterface extends \Psr\Container\ContainerInterface
{
}