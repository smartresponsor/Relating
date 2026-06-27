<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\Campaign;

interface CampaignRepositoryInterface
{
    public function rememberStarted(Campaign $campaign): void;

    public function rememberResponseCaptured(Campaign $campaign): void;

    public function rememberAttributionRecalculated(Campaign $campaign): void;

    public function campaignOf(string $campaignReference): ?Campaign;

    /** @return list<Campaign> */
    public function activeCampaignsForRelationship(string $relationshipReference): array;
}
