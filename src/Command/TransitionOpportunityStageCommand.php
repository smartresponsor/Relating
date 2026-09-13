<?php

declare(strict_types=1);

namespace App\Command;

final readonly class TransitionOpportunityStageCommand
{
    public function __construct(
        public string $opportunityReference,
        public string $stageReference,
        public int $probability,
        public string $forecastCategory = 'pipeline',
        public array $context = [],
    ) {
        if ('' === trim($this->opportunityReference)) {
            throw new \InvalidArgumentException('Opportunity reference cannot be empty.');
        }

        if ('' === trim($this->stageReference)) {
            throw new \InvalidArgumentException('Stage reference cannot be empty.');
        }

        if ($this->probability < 0 || $this->probability > 100) {
            throw new \InvalidArgumentException('Probability must be between 0 and 100.');
        }
    }
}
