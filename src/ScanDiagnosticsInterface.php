<?php

declare(strict_types=1);

namespace SuperKernel\Contract;

/**
 * Exposes skipped-class diagnostics retained with a package or annotation collection.
 *
 * This read capability is not a separate service identity. Names are captured data, not autoload requests.
 */
interface ScanDiagnosticsInterface
{
    /**
     * Returns this value's diagnostics in original scan order.
     *
     * A package exposes its subset; a complete collection combines package subsets.
     * Sequence numbers cover 1 through N across a complete scan. Messages retain their original bytes.
     *
     * @return list<array{
     *     sequence: positive-int,
     *     package: non-empty-string,
     *     class: non-empty-string,
     *     exception_type: non-empty-string,
     *     message: string
     * }>
     */
    public function getDiagnostics(): array;
}
