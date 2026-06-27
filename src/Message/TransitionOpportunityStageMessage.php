<?php

declare(strict_types=1);

namespace App\Message;

final readonly class TransitionOpportunityStageMessage
{
    public function __construct(
        public string $targetReference,
        public array $payload = [],
    ) {
        if (trim($this->targetReference) === '') {
            throw new \InvalidArgumentException('Target reference cannot be empty.');
        }
    }
}
