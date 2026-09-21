<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationCampaignPerformanceProjectionView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'campaign.performance.projection';
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return ['campaignPerformance'];
    }
}
