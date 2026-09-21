<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationOpportunity;

interface RelationOpportunityRepositoryInterface
{
    public function rememberOpened(RelationOpportunity $opportunity): void;

    public function rememberStageChanged(RelationOpportunity $opportunity): void;

    public function rememberForecastRecalculated(RelationOpportunity $opportunity): void;

    public function rememberWon(RelationOpportunity $opportunity): void;

    public function rememberLost(RelationOpportunity $opportunity): void;

    public function opportunityOf(string $opportunityReference): ?RelationOpportunity;

    /** @return list<RelationOpportunity> */
    public function activeOpportunitiesForRelationship(string $relationshipReference): array;
}
