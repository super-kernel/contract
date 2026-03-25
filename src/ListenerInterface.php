<?php
declare (strict_types=1);

namespace SuperKernel\Contract;

interface ListenerInterface
{
	/**
	 * @return array<class-string>
	 */
	public function listen(): array;

	/**
	 * @param object $event
	 */
	public function process(object $event): void;
}
