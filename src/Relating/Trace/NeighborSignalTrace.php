<?php

declare(strict_types=1);

namespace App\Relating\Trace;

use App\Relating\Enum\NeighborComponent;
use App\Relating\Enum\NeighborSignalDirection;
use DateTimeImmutable;
use JsonSerializable;

final readonly class NeighborSignalTrace implements JsonSerializable
{
    public function __construct(
        private TraceCorrelationId $correlationId,
        private NeighborComponent $component,
        private NeighborSignalDirection $direction,
        private string $signalName,
        private TraceSubjectReference $subject,
        private DateTimeImmutable $recordedAt,
        private TraceMetadata $metadata = new TraceMetadata(),
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
            'recordedAt' => $this->recordedAt->format(DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
