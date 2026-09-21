<?php

declare(strict_types=1);

namespace App\Relating\Snapshot;

use App\Relating\Enum\RelationProjectionFreshness;
use App\Relating\Enum\RelationProjectionStatus;
use App\Relating\Enum\RelationReadModelKind;

final readonly class RelationshipTimelineReadModel extends RelationAbstractRelatingReadModel
{
    /**
     * @param list<RelationTimelineEntryReadModel> $entries
     */
    public function __construct(
        string $relationshipReference,
        private array $entries,
        private RelationProjectionFreshness $freshness = RelationProjectionFreshness::Warm,
        RelationProjectionStatus $status = RelationProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(RelationReadModelKind::RelationshipTimeline, $relationshipReference, $status, $projectedAt);
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
                static fn (RelationTimelineEntryReadModel $entry): array => $entry->toPayload(),
                $this->entries,
            ),
        ]);
    }
}
