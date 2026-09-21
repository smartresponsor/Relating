<?php

declare(strict_types=1);

namespace App\Relating\ValueObject;

final readonly class RelationRelatingActionResult
{
    public function __construct(
        public string $businessAction,
        public string $subjectReference,
        public array $payload = [],
    ) {
        if ('' === trim($this->businessAction)) {
            throw new \InvalidArgumentException('Business action cannot be empty.');
        }

        if ('' === trim($this->subjectReference)) {
            throw new \InvalidArgumentException('Subject reference cannot be empty.');
        }
    }
}
