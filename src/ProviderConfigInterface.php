<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

use Composer\Autoload\ClassLoader;

/**
 * @ConfigProviderInterface
 * @\SuperKernel\Contract\ConfigProviderInterface
 */
interface ProviderConfigInterface
{
	public function getCommands(): array;

	public function getDependencies(): array;

	public function getListeners(): array;

	public function getRootPath(): string;

	/**
	 * @return array Return the raw data of `superKernel` in all extra data.
	 */
	public function getProviderConfigs(): array;

	public function getRootPackage(): array;

	public function getAllPackages(): array;

	public function __invoke(): ClassLoader;
}