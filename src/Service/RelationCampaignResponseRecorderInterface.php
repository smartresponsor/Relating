<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationCampaignResponse;

interface RelationCampaignResponseRecorderInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function recordCampaignResponse(string $campaignReference, string $relationshipReference, string $responseType, array $payload = []): RelationCampaignResponse;
}
