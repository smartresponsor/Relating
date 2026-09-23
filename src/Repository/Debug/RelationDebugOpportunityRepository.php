<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationOpportunityEntity;
use App\Relating\Repository\RelationOpportunityRepositoryInterface;

final readonly class RelationDebugOpportunityRepository implements RelationOpportunityRepositoryInterface
{
    private const BUCKET = 'opportunity';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberOpened(RelationOpportunityEntity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberStageChanged(RelationOpportunityEntity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberForecastRecalculated(RelationOpportunityEntity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberWon(RelationOpportunityEntity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberLost(RelationOpportunityEntity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function opportunityOf(string $opportunityReference): ?RelationOpportunityEntity
    {
        $opportunity = $this->store->one(self::BUCKET, $opportunityReference);

        return $opportunity instanceof RelationOpportunityEntity ? $opportunity : null;
    }

    public function activeOpportunitiesForRelationship(string $relationshipReference): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationOpportunityEntity,
        ));
    }

    private function remember(RelationOpportunityEntity $opportunity): void
    {
        $this->store->remember(self::BUCKET, $opportunity->id(), $opportunity);
    }
}
