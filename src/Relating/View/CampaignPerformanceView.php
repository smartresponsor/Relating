<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class CampaignPerformanceView extends AbstractArrayView
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
