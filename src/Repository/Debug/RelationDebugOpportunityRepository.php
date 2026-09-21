<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationOpportunity;
use App\Relating\Repository\RelationOpportunityRepositoryInterface;

final readonly class RelationDebugOpportunityRepository implements RelationOpportunityRepositoryInterface
{
    private const BUCKET = 'opportunity';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberOpened(RelationOpportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberStageChanged(RelationOpportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberForecastRecalculated(RelationOpportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberWon(RelationOpportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberLost(RelationOpportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function opportunityOf(string $opportunityReference): ?RelationOpportunity
    {
        $opportunity = $this->store->one(self::BUCKET, $opportunityReference);

        return $opportunity instanceof RelationOpportunity ? $opportunity : null;
    }

    public function activeOpportunitiesForRelationship(string $relationshipReference): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationOpportunity,
        ));
    }

    private function remember(RelationOpportunity $opportunity): void
    {
        $this->store->remember(self::BUCKET, $opportunity->id(), $opportunity);
    }
}
