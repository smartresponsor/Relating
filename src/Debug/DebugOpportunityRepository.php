<?php

declare(strict_types=1);

namespace App\Debug;

use App\Entity\Opportunity;
use App\Repository\OpportunityRepositoryInterface;

final readonly class DebugOpportunityRepository implements OpportunityRepositoryInterface
{
    private const BUCKET = 'opportunity';

    public function __construct(
        private DebugRelatingObjectStore $store,
    ) {
    }

    public function rememberOpened(Opportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberStageChanged(Opportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberForecastRecalculated(Opportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberWon(Opportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function rememberLost(Opportunity $opportunity): void
    {
        $this->remember($opportunity);
    }

    public function opportunityOf(string $opportunityReference): ?Opportunity
    {
        $opportunity = $this->store->one(self::BUCKET, $opportunityReference);

        return $opportunity instanceof Opportunity ? $opportunity : null;
    }

    public function activeOpportunitiesForRelationship(string $relationshipReference): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof Opportunity,
        ));
    }

    private function remember(Opportunity $opportunity): void
    {
        $this->store->remember(self::BUCKET, $opportunity->id(), $opportunity);
    }
}
