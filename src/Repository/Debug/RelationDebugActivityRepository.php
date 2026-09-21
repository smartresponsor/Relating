<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationActivity;
use App\Relating\Repository\RelationActivityRepositoryInterface;

final readonly class RelationDebugActivityRepository implements RelationActivityRepositoryInterface
{
    private const BUCKET = 'activity';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberRecorded(RelationActivity $activity): void
    {
        $this->remember($activity);
    }

    public function rememberCompleted(RelationActivity $activity): void
    {
        $this->remember($activity);
    }

    public function activityOf(string $activityReference): ?RelationActivity
    {
        $activity = $this->store->one(self::BUCKET, $activityReference);

        return $activity instanceof RelationActivity ? $activity : null;
    }

    public function activitiesForTarget(string $targetType, string $targetReference): array
    {
        return $this->all();
    }

    public function openActivitiesForRelationship(string $relationshipReference): array
    {
        return $this->all();
    }

    /** @return list<RelationActivity> */
    private function all(): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationActivity,
        ));
    }

    private function remember(RelationActivity $activity): void
    {
        $this->store->remember(self::BUCKET, $activity->id(), $activity);
    }
}
