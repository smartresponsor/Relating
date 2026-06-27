<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\View\OpportunityForecastView;

interface OpportunityForecastRecalculatorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function recalculateOpportunityForecast(string $opportunityReference, array $context = []): OpportunityForecastView;
}
