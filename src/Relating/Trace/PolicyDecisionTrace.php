<?php

declare(strict_types=1);

namespace App\Relating\Trace;

use App\Relating\Enum\PolicyDecision;
use App\Relating\Enum\PolicyFailureCode;
use DateTimeImmutable;
use JsonSerializable;

final readonly class PolicyDecisionTrace implements JsonSerializable
{
    public function __construct(
        private TraceCorrelationId $correlationId,
        private string $policyName,
        private TraceSubjectReference $subject,
        private PolicyDecision $decision,
        private ?PolicyFailureCode $failureCode,
        private DateTimeImmutable $decidedAt,
        private TraceMetadata $metadata = new TraceMetadata(),
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'correlationId' => $this->correlationId->value(),
            'policyName' => $this->policyName,
            'subject' => $this->subject,
            'decision' => $this->decision->value,
            'failureCode' => $this->failureCode?->value,
            'decidedAt' => $this->decidedAt->format(DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
