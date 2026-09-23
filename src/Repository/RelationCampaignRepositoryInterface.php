<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationCampaignEntity;

interface RelationCampaignRepositoryInterface
{
    public function rememberStarted(RelationCampaignEntity $campaign): void;

    public function rememberResponseCaptured(RelationCampaignEntity $campaign): void;

    public function rememberAttributionRecalculated(RelationCampaignEntity $campaign): void;

    public function campaignOf(string $campaignReference): ?RelationCampaignEntity;

    /** @return list<RelationCampaignEntity> */
    public function activeCampaignsForRelationship(string $relationshipReference): array;
}
