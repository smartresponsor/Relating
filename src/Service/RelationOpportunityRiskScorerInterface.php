<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Snapshot\View\RelationOpportunityRiskView;

interface RelationOpportunityRiskScorerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function scoreOpportunityRisk(string $opportunityReference, array $context = []): RelationOpportunityRiskView;
}
