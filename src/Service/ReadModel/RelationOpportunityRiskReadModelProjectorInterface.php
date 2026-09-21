<?php

declare(strict_types=1);

namespace App\Relating\Service\ReadModel;

use App\Relating\Snapshot\RelationOpportunityRiskReadModel;

interface RelationOpportunityRiskReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectOpportunityRisk(string $opportunityReference, array $context = []): RelationOpportunityRiskReadModel;
}
