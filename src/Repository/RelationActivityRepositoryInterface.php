<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationActivity;

interface RelationActivityRepositoryInterface
{
    public function rememberRecorded(RelationActivity $activity): void;

    public function rememberCompleted(RelationActivity $activity): void;

    public function activityOf(string $activityReference): ?RelationActivity;

    /** @return list<RelationActivity> */
    public function activitiesForTarget(string $targetType, string $targetReference): array;

    /** @return list<RelationActivity> */
    public function openActivitiesForRelationship(string $relationshipReference): array;
}
