<?php

declare(strict_types=1);

namespace App\Debug;

use App\Entity\TimelineEvent;
use App\Repository\TimelineEventRepositoryInterface;

final readonly class DebugTimelineEventRepository implements TimelineEventRepositoryInterface
{
    private const BUCKET = 'timeline_event';

    public function __construct(
        private DebugRelatingObjectStore $store,
    ) {
    }

    public function rememberProjected(TimelineEvent $event): void
    {
        $this->store->remember(self::BUCKET, $event->id(), $event);
    }

    public function timelineEventOf(string $eventReference): ?TimelineEvent
    {
        $event = $this->store->one(self::BUCKET, $eventReference);

        return $event instanceof TimelineEvent ? $event : null;
    }

    public function timelineForTarget(string $targetType, string $targetReference, int $limit = 100): array
    {
        return array_slice(array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof TimelineEvent,
        )), 0, $limit);
    }
}
