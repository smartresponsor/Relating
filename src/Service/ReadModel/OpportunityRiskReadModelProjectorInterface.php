<?php

declare(strict_types=1);


namespace App\Service\ReadModel;

use App\ReadModel\OpportunityRiskReadModel;

interface OpportunityRiskReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectOpportunityRisk(string $opportunityReference, array $context = []): OpportunityRiskReadModel;
}
