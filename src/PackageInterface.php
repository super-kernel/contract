<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface PackageInterface
{
	public function getName(): ?string;

	public function getType(): string;

	public function getReference(): ?string;

	public function getClassAutoloader(): ClassAutoloaderInterface;

	public function getFiles(): array;

	public function getRawData(): array;
}
