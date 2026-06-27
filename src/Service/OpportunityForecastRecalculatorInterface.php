<?php

declare(strict_types=1);

namespace App\Service;

use App\View\OpportunityForecastView;

interface OpportunityForecastRecalculatorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function recalculateOpportunityForecast(string $opportunityReference, array $context = []): OpportunityForecastView;
}
