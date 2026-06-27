<?php

declare(strict_types=1);


namespace App\Service\ReadModel;

use App\ReadModel\CampaignPerformanceReadModel;

interface CampaignPerformanceReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectCampaignPerformance(string $campaignReference, array $context = []): CampaignPerformanceReadModel;
}
