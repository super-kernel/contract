<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

interface PackageCollectorInterface
{
	/**
	 * Composer plugin package type.
	 */
	public const string COMPOSER_PLUGIN = 'composer-plugin';

	/**
	 * Composer library package type.
	 */
	public const string LIBRARY = 'library';

	/**
	 * Composer metapackage type.
	 */
	public const string METAPACKAGE = 'metapackage';

	/**
	 * Synthetic type used for the current root package.
	 */
	public const string ROOT = 'root';

	/**
	 * @return list<PackageInterface>
	 */
	public function getAllPackages(): array;

	/**
	 * @param non-empty-string $packageName
	 *
	 * @return PackageInterface
	 */
	public function getPackage(string $packageName): PackageInterface;

	/**
	 * @param non-empty-string $packageName
	 */
	public function hasPackage(string $packageName): bool;

	/**
	 * @param non-empty-string $packageType
	 *
	 * @return list<PackageInterface>
	 */
	public function getPackagesByType(string $packageType): array;

	public function getRootPackage(): PackageInterface;
}
