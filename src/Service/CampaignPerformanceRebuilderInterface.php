<?php

declare(strict_types=1);

namespace App\Service;

use App\Snapshot\View\CampaignPerformanceView;

interface CampaignPerformanceRebuilderInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function rebuildCampaignPerformance(string $campaignReference, array $context = []): CampaignPerformanceView;
}
