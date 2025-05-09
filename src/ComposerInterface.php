<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * @ComposerInterface
 * @\SuperKernel\Contract\ComposerInterface
 */
interface ComposerInterface
{
	public function getDependencies(): array;

	public function getRootPath(): string;

	public function getVendorDir(): string;

	public function getListeners(): array;
}