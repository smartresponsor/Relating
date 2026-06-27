<?php

declare(strict_types=1);


namespace App\Relating\Service\ReadModel;

use App\Relating\ReadModel\CampaignPerformanceReadModel;

interface CampaignPerformanceReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectCampaignPerformance(string $campaignReference, array $context = []): CampaignPerformanceReadModel;
}
