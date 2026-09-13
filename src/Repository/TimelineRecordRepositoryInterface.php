<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TimelineRecord;

interface TimelineRecordRepositoryInterface
{
    public function rememberProjected(TimelineRecord $event): void;

    public function timelineEventOf(string $eventReference): ?TimelineRecord;

    /** @return list<TimelineRecord> */
    public function timelineForTarget(string $targetType, string $targetReference, int $limit = 100): array;
}
