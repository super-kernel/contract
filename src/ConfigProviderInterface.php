<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Dependency libraries and configuration providers defined by developers must implement this interface.
 * Warning: The implementation of this interface prohibits participation in operational interactions with containers.
 *
 * @ConfigProviderInterface
 * @\SuperKernel\Contract\ConfigProviderInterface
 */
interface ConfigProviderInterface
{
	/**
	 * @return array{
	 *     paths?: string[],        //  The directory path to be scanned.
	 *     namespaces?: string[],   //  The namespace prefix to be scanned.
	 *     classes?: string[],      //  The specified class name to be scanned.
	 * }
	 */
	public function __invoke(): array;
}