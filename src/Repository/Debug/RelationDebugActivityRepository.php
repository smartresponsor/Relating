<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationActivityEntity;
use App\Relating\Repository\RelationActivityRepositoryInterface;

final readonly class RelationDebugActivityRepository implements RelationActivityRepositoryInterface
{
    private const BUCKET = 'activity';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberRecorded(RelationActivityEntity $activity): void
    {
        $this->remember($activity);
    }

    public function rememberCompleted(RelationActivityEntity $activity): void
    {
        $this->remember($activity);
    }

    public function activityOf(string $activityReference): ?RelationActivityEntity
    {
        $activity = $this->store->one(self::BUCKET, $activityReference);

        return $activity instanceof RelationActivityEntity ? $activity : null;
    }

    public function activitiesForTarget(string $targetType, string $targetReference): array
    {
        return $this->all();
    }

    public function openActivitiesForRelationship(string $relationshipReference): array
    {
        return $this->all();
    }

    /** @return list<RelationActivityEntity> */
    private function all(): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationActivityEntity,
        ));
    }

    private function remember(RelationActivityEntity $activity): void
    {
        $this->store->remember(self::BUCKET, $activity->id(), $activity);
    }
}
