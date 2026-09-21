<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationCampaignResponseView extends RelationAbstractArrayView
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
