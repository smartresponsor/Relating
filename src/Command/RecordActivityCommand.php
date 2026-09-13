<?php

declare(strict_types=1);

namespace App\Command;

final readonly class RecordActivityCommand
{
    public function __construct(
        public string $targetType,
        public string $targetReference,
        public string $activityType = 'task',
        public string $direction = 'internal',
        public ?string $relationshipReference = null,
        public ?string $ownerReference = null,
        public ?string $subject = null,
        public ?string $body = null,
        public ?\DateTimeImmutable $dueAt = null,
        public array $payload = [],
    ) {
        if ('' === trim($this->targetType)) {
            throw new \InvalidArgumentException('Target type cannot be empty.');
        }

        if ('' === trim($this->targetReference)) {
            throw new \InvalidArgumentException('Target reference cannot be empty.');
        }
    }
}
