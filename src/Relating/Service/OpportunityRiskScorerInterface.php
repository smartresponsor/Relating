<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\View\OpportunityRiskView;

interface OpportunityRiskScorerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function scoreOpportunityRisk(string $opportunityReference, array $context = []): OpportunityRiskView;
}
