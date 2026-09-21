<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationOpportunityForecastView extends RelationAbstractArrayView
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
