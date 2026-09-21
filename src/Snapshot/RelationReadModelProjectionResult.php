<?php

declare(strict_types=1);

namespace App\Relating\Snapshot;

final readonly class RelationReadModelProjectionResult
{
    public function __construct(
        public string $projectionReference,
        public string $readModelKind,
        public string $targetReference,
        public bool $accepted,
        public string $message = '',
    ) {
        if ('' === trim($this->projectionReference)) {
            throw new \InvalidArgumentException('Projection reference cannot be empty.');
        }
    }
}
