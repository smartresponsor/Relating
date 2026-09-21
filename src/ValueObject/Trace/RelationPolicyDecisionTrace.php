<?php

declare(strict_types=1);

namespace App\Relating\ValueObject\Trace;

use App\Relating\Enum\RelationPolicyDecision;
use App\Relating\Enum\RelationPolicyFailureCode;

final readonly class RelationPolicyDecisionTrace implements \JsonSerializable
{
    public function __construct(
        private RelationTraceCorrelationId $correlationId,
        private string $policyName,
        private RelationTraceSubjectReference $subject,
        private RelationPolicyDecision $decision,
        private ?RelationPolicyFailureCode $failureCode,
        private \DateTimeImmutable $decidedAt,
        private RelationTraceMetadata $metadata = new RelationTraceMetadata(),
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
            'decidedAt' => $this->decidedAt->format(\DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
