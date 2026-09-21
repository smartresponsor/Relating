<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationTimelineRecord;

interface RelationTimelineRecordRepositoryInterface
{
    public function rememberProjected(RelationTimelineRecord $event): void;

    public function timelineEventOf(string $eventReference): ?RelationTimelineRecord;

    /** @return list<RelationTimelineRecord> */
    public function timelineForTarget(string $targetType, string $targetReference, int $limit = 100): array;
}
