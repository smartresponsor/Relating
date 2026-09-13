<?php

declare(strict_types=1);

namespace App\Service\ReadModel;

use App\Snapshot\OpportunityForecastReadModel;

interface OpportunityForecastReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectOpportunityForecast(string $opportunityReference, array $context = []): OpportunityForecastReadModel;
}
