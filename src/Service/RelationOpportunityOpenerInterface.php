<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationOpportunityEntity;

interface RelationOpportunityOpenerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function openOpportunityForRelationship(string $relationshipReference, string $pipelineReference, array $context = []): RelationOpportunityEntity;
}
