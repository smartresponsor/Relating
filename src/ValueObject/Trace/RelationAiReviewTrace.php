<?php

declare(strict_types=1);

namespace App\Relating\ValueObject\Trace;

use App\Relating\Enum\RelationAiSuggestionDecision;

final readonly class RelationAiReviewTrace implements \JsonSerializable
{
    public function __construct(
        private RelationTraceCorrelationId $correlationId,
        private string $suggestionReference,
        private RelationTraceActorReference $reviewer,
        private RelationAiSuggestionDecision $decision,
        private \DateTimeImmutable $reviewedAt,
        private RelationTraceMetadata $metadata = new RelationTraceMetadata(),
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'correlationId' => $this->correlationId->value(),
            'suggestionReference' => $this->suggestionReference,
            'reviewer' => $this->reviewer,
            'decision' => $this->decision->value,
            'reviewedAt' => $this->reviewedAt->format(\DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
