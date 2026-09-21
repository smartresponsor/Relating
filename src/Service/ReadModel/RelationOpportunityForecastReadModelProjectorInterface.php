<?php

declare(strict_types=1);

namespace App\Relating\Service\ReadModel;

use App\Relating\Snapshot\RelationOpportunityForecastReadModel;

interface RelationOpportunityForecastReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectOpportunityForecast(string $opportunityReference, array $context = []): RelationOpportunityForecastReadModel;
}
