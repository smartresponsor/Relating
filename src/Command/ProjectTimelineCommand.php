<?php

declare(strict_types=1);

namespace App\Command;

final readonly class ProjectTimelineCommand
{
    public function __construct(
        public string $targetType,
        public string $targetReference,
        public string $eventKind,
        public ?string $relationshipReference = null,
        public ?string $sourceComponent = null,
        public ?string $sourceReference = null,
        public array $payload = [],
        public ?\DateTimeImmutable $occurredAt = null,
    ) {
        if ('' === trim($this->targetType)) {
            throw new \InvalidArgumentException('Target type cannot be empty.');
        }

        if ('' === trim($this->targetReference)) {
            throw new \InvalidArgumentException('Target reference cannot be empty.');
        }

        if ('' === trim($this->eventKind)) {
            throw new \InvalidArgumentException('Event kind cannot be empty.');
        }
    }
}
