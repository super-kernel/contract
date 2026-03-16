<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

interface PathResolverInterface
{
	public function get(): string;

	public function to(string $path): PathResolverInterface;
}