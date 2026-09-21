<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Snapshot\View\RelationCampaignPerformanceView;

interface RelationCampaignPerformanceRebuilderInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function rebuildCampaignPerformance(string $campaignReference, array $context = []): RelationCampaignPerformanceView;
}
