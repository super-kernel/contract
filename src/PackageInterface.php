<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface PackageInterface
{
	public function getName(): ?string;

	public function getType(): string;

	public function getVersion(): ?string;

	public function getReference(): ?string;

	public function getClassMap(): array;

	public function toArray(): array;
}