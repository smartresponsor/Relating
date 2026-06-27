<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\TimelineEvent;

interface TimelineEventRepositoryInterface
{
    public function rememberProjected(TimelineEvent $event): void;

    public function timelineEventOf(string $eventReference): ?TimelineEvent;

    /** @return list<TimelineEvent> */
    public function timelineForTarget(string $targetType, string $targetReference, int $limit = 100): array;
}
