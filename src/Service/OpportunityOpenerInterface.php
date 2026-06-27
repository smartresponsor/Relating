<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Opportunity;

interface OpportunityOpenerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function openOpportunityForRelationship(string $relationshipReference, string $pipelineReference, array $context = []): Opportunity;
}
