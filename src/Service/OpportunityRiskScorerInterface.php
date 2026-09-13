<?php

declare(strict_types=1);

namespace App\Service;

use App\Snapshot\View\OpportunityRiskView;

interface OpportunityRiskScorerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function scoreOpportunityRisk(string $opportunityReference, array $context = []): OpportunityRiskView;
}
