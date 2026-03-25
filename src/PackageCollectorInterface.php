<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface PackageCollectorInterface
{
	public const string COMPOSER_PLUGIN = 'composer-plugin';

	public const string LIBRARY = 'library';

	public const string METAPACKAGE = 'metapackage';

	public const string ROOT = 'root';

	/**
	 * @return array<PackageInterface>
	 */
	public function getAllPackages(): array;

	/**
	 * @param non-empty-string $packageName
	 *
	 * @return PackageInterface
	 */
	public function getPackage(string $packageName): PackageInterface;

	public function hasPackage(string $packageName): bool;

	public function getPackagesByType(string $packageType): array;

	public function getRootPackage(): PackageInterface;
}
