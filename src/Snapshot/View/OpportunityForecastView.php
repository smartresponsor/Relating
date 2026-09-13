<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class OpportunityForecastView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'opportunity.forecast';
    }

    public static function expectedKeys(): array
    {
        return ['pipelineId', 'period', 'amount', 'weightedAmount', 'categories'];
    }
}
