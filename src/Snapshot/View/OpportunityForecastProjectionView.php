<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class OpportunityForecastProjectionView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'opportunity.forecast.projection';
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return ['opportunityForecast'];
    }
}
