<?php

declare(strict_types=1);

namespace App\Command;

final readonly class OpenOpportunityCommand
{
    public function __construct(
        public string $relationshipReference,
        public string $pipelineReference,
        public string $stageReference,
        public string $name,
        public ?string $tenantReference = null,
        public ?string $productReference = null,
        public string $currency = 'USD',
        public int $amountMinor = 0,
        public array $context = [],
    ) {
        foreach (['Relationship reference' => $this->relationshipReference, 'Pipeline reference' => $this->pipelineReference, 'Stage reference' => $this->stageReference, 'Opportunity name' => $this->name] as $label => $value) {
            if ('' === trim($value)) {
                throw new \InvalidArgumentException($label.' cannot be empty.');
            }
        }

        if ($this->amountMinor < 0) {
            throw new \InvalidArgumentException('Amount cannot be negative.');
        }
    }
}
