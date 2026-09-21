<?php

declare(strict_types=1);

namespace App\Relating\ValueObject\Trace;

use App\Relating\Enum\RelationNeighborComponent;
use App\Relating\Enum\RelationNeighborSignalDirection;

final readonly class RelationNeighborSignalTrace implements \JsonSerializable
{
    public function __construct(
        private RelationTraceCorrelationId $correlationId,
        private RelationNeighborComponent $component,
        private RelationNeighborSignalDirection $direction,
        private string $signalName,
        private RelationTraceSubjectReference $subject,
        private \DateTimeImmutable $recordedAt,
        private RelationTraceMetadata $metadata = new RelationTraceMetadata(),
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'correlationId' => $this->correlationId->value(),
            'component' => $this->component->value,
            'direction' => $this->direction->value,
            'signalName' => $this->signalName,
            'subject' => $this->subject,
            'recordedAt' => $this->recordedAt->format(\DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
