<?php
declare (strict_types=1);

namespace SuperKernel\Contract;

interface ListenerInterface
{
	/**
	 * @param object $event
	 */
	public function process(object $event): void;
}