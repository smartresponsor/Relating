<?php

declare(strict_types=1);

namespace App\Repository\Debug;

use App\Entity\TimelineRecord;
use App\Repository\TimelineRecordRepositoryInterface;

final readonly class DebugTimelineRecordRepository implements TimelineRecordRepositoryInterface
{
    private const BUCKET = 'timeline_event';

    public function __construct(
        private DebugRelatingObjectStore $store,
    ) {
    }

    public function rememberProjected(TimelineRecord $event): void
    {
        $this->store->remember(self::BUCKET, $event->id(), $event);
    }

    public function timelineEventOf(string $eventReference): ?TimelineRecord
    {
        $event = $this->store->one(self::BUCKET, $eventReference);

        return $event instanceof TimelineRecord ? $event : null;
    }

    public function timelineForTarget(string $targetType, string $targetReference, int $limit = 100): array
    {
        return \array_slice(array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof TimelineRecord,
        )), 0, $limit);
    }
}
