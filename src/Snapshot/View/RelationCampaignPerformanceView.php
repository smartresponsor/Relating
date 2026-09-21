<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationCampaignPerformanceView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'campaign.performance';
    }

    public static function expectedKeys(): array
    {
        return ['campaignId', 'touches', 'responses', 'attribution', 'generatedAt'];
    }
}
