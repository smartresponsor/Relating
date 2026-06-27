<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\Opportunity;

interface OpportunityRepositoryInterface
{
    public function rememberOpened(Opportunity $opportunity): void;

    public function rememberStageChanged(Opportunity $opportunity): void;

    public function rememberForecastRecalculated(Opportunity $opportunity): void;

    public function rememberWon(Opportunity $opportunity): void;

    public function rememberLost(Opportunity $opportunity): void;

    public function opportunityOf(string $opportunityReference): ?Opportunity;

    /** @return list<Opportunity> */
    public function activeOpportunitiesForRelationship(string $relationshipReference): array;
}
