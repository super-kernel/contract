<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * @template TEvent of object
 */
interface ListenerInterface
{
	/**
	 * @return list<class-string<TEvent>>
	 */
	public function listen(): array;

	/**
	 * @param TEvent $event
	 */
	public function process(object $event): void;
}
