<?php
declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Interface ClassLoaderInterface
 *
 * High-performance class resolution mechanism based on explicit mapping.
 *
 * DESIGN GUIDELINES:
 *
 * 1. IMMUTABILITY
 *
 *      Implementations SHOULD be designed as immutable. The internal class map SHOULD NOT be modified after
 *      registration to ensure resolution consistency across the SPL stack.
 *
 * 2. HIJACKING & PRIORITY
 *
 *      Callers SHOULD manage multiple loader instances to control loading logic. To override or "hijack" a specific
 *      class loading behavior, a new loader instance with higher priority ($prepend = true) SHOULD be registered
 *      before the target class is first referenced.
 *
 * 3. PERSISTENCE & CONCURRENCY
 *
 *      In long-running environments (e.g., Multi-process, Coroutines, Threads):
 *
 *          - MANDATORY WARM-UP: Callers MUST trigger a full warm-up (preloading all necessary classes) before
 *          attempting to unregister loader.
 *
 *          - PERFORMANCE OPTIMIZATION: Once the warm-up is complete and all class definitions are in memory, callers
 *          SHOULD call unregister() to eliminate redundant SPL stack polling overhead.
 *
 *          - RISK MITIGATION: This sequence prevents "partial loading" failures or inconsistent states in worker
 *          processes or concurrent handlers.
 */
interface ClassLoaderInterface
{
	/**
	 * Returns the current class map registry.
	 *
	 * @return array<class-string, string> An associative array where keys are FQCNs and values are their corresponding
	 *                                     absolute file paths.
	 */
	public function getClassMap(): array;

	/**
	 * Registers the instance into the SPL autoloader stack.
	 *
	 * @param bool $prepend If true, `spl_autoload_register()` will prepend the autoloader on the autoload queue instead
	 *                      of appending it.
	 *
	 * @return void
	 */
	public function register(bool $prepend = false): void;

	/**
	 * Unregisters the instance from the SPL autoloader stack.
	 *
	 * IMPORTANT: In persistent applications, ensure a full class warm-up has been performed before calling this method
	 * to avoid runtime resolution errors.
	 *
	 * @return void
	 */
	public function unregister(): void;
}
