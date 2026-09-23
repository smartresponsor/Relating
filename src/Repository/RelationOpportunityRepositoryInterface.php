<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationOpportunityEntity;

interface RelationOpportunityRepositoryInterface
{
    public function rememberOpened(RelationOpportunityEntity $opportunity): void;

    public function rememberStageChanged(RelationOpportunityEntity $opportunity): void;

    public function rememberForecastRecalculated(RelationOpportunityEntity $opportunity): void;

    public function rememberWon(RelationOpportunityEntity $opportunity): void;

    public function rememberLost(RelationOpportunityEntity $opportunity): void;

    public function opportunityOf(string $opportunityReference): ?RelationOpportunityEntity;

    /** @return list<RelationOpportunityEntity> */
    public function activeOpportunitiesForRelationship(string $relationshipReference): array;
}
