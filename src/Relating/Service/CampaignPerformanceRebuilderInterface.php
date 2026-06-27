<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\View\CampaignPerformanceView;

interface CampaignPerformanceRebuilderInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function rebuildCampaignPerformance(string $campaignReference, array $context = []): CampaignPerformanceView;
}
