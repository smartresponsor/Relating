<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\CampaignResponse;

interface CampaignResponseRecorderInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function recordCampaignResponse(string $campaignReference, string $relationshipReference, string $responseType, array $payload = []): CampaignResponse;
}
