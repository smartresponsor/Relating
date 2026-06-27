<?php

declare(strict_types=1);


namespace App\Relating\ReadModel;

final readonly class ReadModelProjectionResult
{
    public function __construct(
        public string $projectionReference,
        public string $readModelKind,
        public string $targetReference,
        public bool $accepted,
        public string $message = '',
    ) {
        if (trim($this->projectionReference) === '') {
            throw new \InvalidArgumentException('Projection reference cannot be empty.');
        }
    }
}
