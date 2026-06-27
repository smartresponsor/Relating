<?php

declare(strict_types=1);

namespace App\Trace;

use App\Enum\TraceDecisionKind;
use App\Enum\TraceOutcome;
use App\Enum\TraceRetentionClass;
use DateTimeImmutable;
use JsonSerializable;

final readonly class BusinessDecisionTrace implements JsonSerializable
{
    public function __construct(
        private TraceCorrelationId $correlationId,
        private TraceDecisionKind $decisionKind,
        private TraceSubjectReference $subject,
        private TraceActorReference $actor,
        private TraceOutcome $outcome,
        private TraceRetentionClass $retentionClass,
        private DateTimeImmutable $decidedAt,
        private TraceMetadata $metadata = new TraceMetadata(),
    ) {
    }

    public function correlationId(): TraceCorrelationId
    {
        return $this->correlationId;
    }

    public function decisionKind(): TraceDecisionKind
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
            'decidedAt' => $this->decidedAt->format(DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
