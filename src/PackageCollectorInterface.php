<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface PackageCollectorInterface
{
	public const string LIBRARY = 'library';

	public const string ROOT = 'root';

	public const string METAPACKAGE = 'metapackage';

	public const string COMPOSER_PLUGIN = 'composer-plugin';

	public function getRootPackage(): PackageInterface;

	public function getPackage(string $packageName): PackageInterface;

	public function getPackagesByType(string $packageType): array;

	public function hasPackage(string $packageName): bool;

	/**
	 * @return array<PackageInterface>
	 */
	public function getAllPackages(): array;
}