<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\Activity;

interface ActivityRepositoryInterface
{
    public function rememberRecorded(Activity $activity): void;

    public function rememberCompleted(Activity $activity): void;

    public function activityOf(string $activityReference): ?Activity;

    /** @return list<Activity> */
    public function activitiesForTarget(string $targetType, string $targetReference): array;

    /** @return list<Activity> */
    public function openActivitiesForRelationship(string $relationshipReference): array;
}
