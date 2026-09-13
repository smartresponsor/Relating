<?php

declare(strict_types=1);

namespace App\Snapshot;

final readonly class TimelineEntryReadModel
{
    /**
     * @param array<string, scalar|null> $metadata
     */
    public function __construct(
        public string $eventReference,
        public string $kind,
        public string $title,
        public string $summary,
        public \DateTimeImmutable $occurredAt,
        public string $actorReference = '',
        public string $subjectReference = '',
        public string $signalReference = '',
        public array $metadata = [],
    ) {
        if ('' === trim($this->eventReference)) {
            throw new \InvalidArgumentException('Timeline entry event reference cannot be empty.');
        }

        if ('' === trim($this->kind)) {
            throw new \InvalidArgumentException('Timeline entry kind cannot be empty.');
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        return [
            'eventReference' => $this->eventReference,
            'kind' => $this->kind,
            'title' => $this->title,
            'summary' => $this->summary,
            'occurredAt' => $this->occurredAt->format(\DATE_ATOM),
            'actorReference' => $this->actorReference,
            'subjectReference' => $this->subjectReference,
            'signalReference' => $this->signalReference,
            'metadata' => $this->metadata,
        ];
    }
}
