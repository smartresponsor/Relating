<?php

declare(strict_types=1);

namespace App\Relating\ValueObject\Trace;

use App\Relating\Enum\RelationTraceDecisionKind;
use App\Relating\Enum\RelationTraceOutcome;
use App\Relating\Enum\RelationTraceRetentionClass;

final readonly class RelationBusinessDecisionTrace implements \JsonSerializable
{
    public function __construct(
        private RelationTraceCorrelationId $correlationId,
        private RelationTraceDecisionKind $decisionKind,
        private RelationTraceSubjectReference $subject,
        private RelationTraceActorReference $actor,
        private RelationTraceOutcome $outcome,
        private RelationTraceRetentionClass $retentionClass,
        private \DateTimeImmutable $decidedAt,
        private RelationTraceMetadata $metadata = new RelationTraceMetadata(),
    ) {
    }

    public function correlationId(): RelationTraceCorrelationId
    {
        return $this->correlationId;
    }

    public function decisionKind(): RelationTraceDecisionKind
    {
        return $this->decisionKind;
    }

    public function jsonSerialize(): array
    {
        return [
            'correlationId' => $this->correlationId->value(),
            'decisionKind' => $this->decisionKind->value,
            'subject' => $this->subject,
            'actor' => $this->actor,
            'outcome' => $this->outcome->value,
            'retentionClass' => $this->retentionClass->value,
            'decidedAt' => $this->decidedAt->format(\DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
