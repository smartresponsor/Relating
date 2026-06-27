<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class CampaignResponseView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'campaign.response';
    }

    public static function expectedKeys(): array
    {
        return ['campaignId', 'responses', 'nextCursor', 'generatedAt'];
    }
}
