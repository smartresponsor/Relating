<?php

declare(strict_types=1);

namespace App\Relating\Service\ReadModel;

use App\Relating\Snapshot\RelationCampaignPerformanceReadModel;

interface RelationCampaignPerformanceReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectCampaignPerformance(string $campaignReference, array $context = []): RelationCampaignPerformanceReadModel;
}
