<?php

declare(strict_types=1);

namespace App\ValueObject\Trace;

use App\Enum\AiSuggestionDecision;

final readonly class AiReviewTrace implements \JsonSerializable
{
    public function __construct(
        private TraceCorrelationId $correlationId,
        private string $suggestionReference,
        private TraceActorReference $reviewer,
        private AiSuggestionDecision $decision,
        private \DateTimeImmutable $reviewedAt,
        private TraceMetadata $metadata = new TraceMetadata(),
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
