<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationTimelineRecordEntity;
use App\Relating\Repository\RelationTimelineRecordRepositoryInterface;

final readonly class RelationDebugTimelineRecordRepository implements RelationTimelineRecordRepositoryInterface
{
    private const BUCKET = 'timeline_event';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberProjected(RelationTimelineRecordEntity $event): void
    {
        $this->store->remember(self::BUCKET, $event->id(), $event);
    }

    public function timelineEventOf(string $eventReference): ?RelationTimelineRecordEntity
    {
        $event = $this->store->one(self::BUCKET, $eventReference);

        return $event instanceof RelationTimelineRecordEntity ? $event : null;
    }

    public function timelineForTarget(string $targetType, string $targetReference, int $limit = 100): array
    {
        return \array_slice(array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationTimelineRecordEntity,
        )), 0, $limit);
    }
}
