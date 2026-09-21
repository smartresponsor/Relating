<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationCampaign;

interface RelationCampaignRepositoryInterface
{
    public function rememberStarted(RelationCampaign $campaign): void;

    public function rememberResponseCaptured(RelationCampaign $campaign): void;

    public function rememberAttributionRecalculated(RelationCampaign $campaign): void;

    public function campaignOf(string $campaignReference): ?RelationCampaign;

    /** @return list<RelationCampaign> */
    public function activeCampaignsForRelationship(string $relationshipReference): array;
}
