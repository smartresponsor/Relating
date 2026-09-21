<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Snapshot\View\RelationOpportunityForecastView;

interface RelationOpportunityForecastRecalculatorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function recalculateOpportunityForecast(string $opportunityReference, array $context = []): RelationOpportunityForecastView;
}
