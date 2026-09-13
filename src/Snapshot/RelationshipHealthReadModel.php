<?php

declare(strict_types=1);

namespace App\Snapshot;

use App\Enum\ProjectionStatus;
use App\Enum\ReadModelKind;

final readonly class RelationshipHealthReadModel extends AbstractRelatingReadModel
{
    /**
     * @param list<string> $signalCodes
     */
    public function __construct(
        string $relationshipReference,
        private int $healthScore,
        private int $engagementScore,
        private string $lifecycleStage,
        private array $signalCodes = [],
        private ?\DateTimeImmutable $nextActionAt = null,
        ProjectionStatus $status = ProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(ReadModelKind::RelationshipHealth, $relationshipReference, $status, $projectedAt);

        if ($this->healthScore < 0 || $this->healthScore > 100) {
            throw new \InvalidArgumentException('Health score must be between 0 and 100.');
        }

        if ($this->engagementScore < 0 || $this->engagementScore > 100) {
            throw new \InvalidArgumentException('Engagement score must be between 0 and 100.');
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        return $this->withEnvelope([
            'relationshipReference' => $this->reference(),
            'healthScore' => $this->healthScore,
            'engagementScore' => $this->engagementScore,
            'lifecycleStage' => $this->lifecycleStage,
            'signalCodes' => $this->signalCodes,
            'nextActionAt' => $this->nextActionAt?->format(\DATE_ATOM),
        ]);
    }
}
