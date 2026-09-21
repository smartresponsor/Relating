<?php

declare(strict_types=1);

namespace App\Relating\Command;

final readonly class RelationConvertLeadCommand
{
    public function __construct(
        public string $leadReference,
        public string $vendorReference,
        public ?string $pipelineReference = null,
        public ?string $stageReference = null,
        public ?string $opportunityName = null,
        public array $context = [],
    ) {
        if ('' === trim($this->leadReference)) {
            throw new \InvalidArgumentException('RelationLead reference cannot be empty.');
        }

        if ('' === trim($this->vendorReference)) {
            throw new \InvalidArgumentException('Vendor reference cannot be empty.');
        }
    }
}
