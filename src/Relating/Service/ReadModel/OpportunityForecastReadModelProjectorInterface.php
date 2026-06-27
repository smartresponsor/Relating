<?php

declare(strict_types=1);


namespace App\Relating\Service\ReadModel;

use App\Relating\ReadModel\OpportunityForecastReadModel;

interface OpportunityForecastReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectOpportunityForecast(string $opportunityReference, array $context = []): OpportunityForecastReadModel;
}
