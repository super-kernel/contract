<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Declares the event types handled by a synchronous listener and processes matching event objects.
 *
 * Implementations that declare multiple event types are responsible for distinguishing the concrete event in
 * process().
 */
interface ListenerInterface
{
    /**
     * Returns the event class names handled by this listener.
     *
     * @return list<class-string>
     */
    public function listen(): array;

    /**
     * Processes one event whose type matches an entry returned by listen().
     */
    public function process(object $event): void;
}
