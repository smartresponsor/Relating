<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationTimelineRecordEntity;

interface RelationTimelineRecordRepositoryInterface
{
    public function rememberProjected(RelationTimelineRecordEntity $event): void;

    public function timelineEventOf(string $eventReference): ?RelationTimelineRecordEntity;

    /** @return list<RelationTimelineRecordEntity> */
    public function timelineForTarget(string $targetType, string $targetReference, int $limit = 100): array;
}
