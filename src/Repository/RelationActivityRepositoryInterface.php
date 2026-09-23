<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationActivityEntity;

interface RelationActivityRepositoryInterface
{
    public function rememberRecorded(RelationActivityEntity $activity): void;

    public function rememberCompleted(RelationActivityEntity $activity): void;

    public function activityOf(string $activityReference): ?RelationActivityEntity;

    /** @return list<RelationActivityEntity> */
    public function activitiesForTarget(string $targetType, string $targetReference): array;

    /** @return list<RelationActivityEntity> */
    public function openActivitiesForRelationship(string $relationshipReference): array;
}
