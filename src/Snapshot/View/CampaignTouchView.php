<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class CampaignTouchView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['campaignId', 'touches'];
    }
}
