<?php
declare (strict_types=1);

namespace SuperKernel\Contract;

/**
 * @ListenerInterface
 * @\SuperKernel\Contract\ListenerInterface
 */
interface ListenerInterface
{
	/**
	 * @param object $event
	 */
	public function process(object $event): void;
}