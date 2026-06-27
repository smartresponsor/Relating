<?php

declare(strict_types=1);

namespace App\Relating\Debug;

use App\Relating\Entity\Activity;
use App\Relating\Repository\ActivityRepositoryInterface;

final readonly class DebugActivityRepository implements ActivityRepositoryInterface
{
    private const BUCKET = 'activity';

    public function __construct(
        private DebugRelatingObjectStore $store,
    ) {
    }

    public function rememberRecorded(Activity $activity): void
    {
        $this->remember($activity);
    }

    public function rememberCompleted(Activity $activity): void
    {
        $this->remember($activity);
    }

    public function activityOf(string $activityReference): ?Activity
    {
        $activity = $this->store->one(self::BUCKET, $activityReference);

        return $activity instanceof Activity ? $activity : null;
    }

    public function activitiesForTarget(string $targetType, string $targetReference): array
    {
        return $this->all();
    }

    public function openActivitiesForRelationship(string $relationshipReference): array
    {
        return $this->all();
    }

    /** @return list<Activity> */
    private function all(): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof Activity,
        ));
    }

    private function remember(Activity $activity): void
    {
        $this->store->remember(self::BUCKET, $activity->id(), $activity);
    }
}
