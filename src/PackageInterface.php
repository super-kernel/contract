<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

interface PackageInterface
{
	/**
	 * @return non-empty-string|null
	 */
	public function getName(): ?string;

	/**
	 * @return non-empty-string
	 */
	public function getType(): string;

	/**
	 * @return non-empty-string|null
	 */
	public function getReference(): ?string;

	public function getClassLoader(PathResolverInterface $pathResolver): ClassLoaderInterface;

	/**
	 * @return list<non-empty-string>
	 */
	public function getFiles(): array;

	/**
	 * @return array<string, mixed>
	 */
	public function getRawData(): array;
}
