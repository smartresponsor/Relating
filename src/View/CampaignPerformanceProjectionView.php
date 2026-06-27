<?php

declare(strict_types=1);


namespace App\View;

final readonly class CampaignPerformanceProjectionView extends AbstractArrayView
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
