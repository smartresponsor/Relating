<?php

declare(strict_types=1);

namespace App\Snapshot;

use App\Enum\ProjectionFreshness;
use App\Enum\ProjectionStatus;
use App\Enum\ReadModelKind;

final readonly class RelationshipTimelineReadModel extends AbstractRelatingReadModel
{
    /**
     * @param list<TimelineEntryReadModel> $entries
     */
    public function __construct(
        string $relationshipReference,
        private array $entries,
        private ProjectionFreshness $freshness = ProjectionFreshness::Warm,
        ProjectionStatus $status = ProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(ReadModelKind::RelationshipTimeline, $relationshipReference, $status, $projectedAt);
    }

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        return $this->withEnvelope([
            'relationshipReference' => $this->reference(),
            'freshness' => $this->freshness->value,
            'entries' => array_map(
                static fn (TimelineEntryReadModel $entry): array => $entry->toPayload(),
                $this->entries,
            ),
        ]);
    }
}
