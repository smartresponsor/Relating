<?php

declare(strict_types=1);

namespace App\View;

final readonly class CampaignMemberView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['campaignId', 'members'];
    }
}
