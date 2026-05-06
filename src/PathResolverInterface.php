<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

interface PathResolverInterface
{
	/**
	 * Returns the resolved absolute path.
	 *
	 * @return non-empty-string
	 */
	public function get(): string;

	/**
	 * Resolves a child path from the current path context.
	 *
	 * @param non-empty-string $path
	 */
	public function to(string $path): static;
}
