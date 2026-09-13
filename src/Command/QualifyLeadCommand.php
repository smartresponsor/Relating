<?php

declare(strict_types=1);

namespace App\Command;

final readonly class QualifyLeadCommand
{
    public function __construct(
        public string $leadReference,
        public int $score,
        public string $temperature = 'warm',
        public array $context = [],
    ) {
        if ('' === trim($this->leadReference)) {
            throw new \InvalidArgumentException('Lead reference cannot be empty.');
        }

        if ($this->score < 0 || $this->score > 100) {
            throw new \InvalidArgumentException('Lead score must be between 0 and 100.');
        }
    }
}
