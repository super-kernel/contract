<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface PackageMetadataInterface
{
	public function getName(): string;

	public function getReference(): ?string;

	/**
	 * @return array<AttributeMetadataInterface>
	 */
	public function getAttributes(): array;
}