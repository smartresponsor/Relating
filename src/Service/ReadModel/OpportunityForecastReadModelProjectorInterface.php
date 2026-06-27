<?php

declare(strict_types=1);


namespace App\Service\ReadModel;

use App\ReadModel\OpportunityForecastReadModel;

interface OpportunityForecastReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectOpportunityForecast(string $opportunityReference, array $context = []): OpportunityForecastReadModel;
}
