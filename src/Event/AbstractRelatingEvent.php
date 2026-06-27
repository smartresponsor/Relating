<?php

declare(strict_types=1);


namespace App\Event;

use DateTimeImmutable;

abstract readonly class AbstractRelatingEvent
{
    private string $aggregateReference;
    private array $payload;
    private DateTimeImmutable $occurredAt;

    public function __construct(
        string $aggregateReference,
        array $payload = [],
        ?DateTimeImmutable $occurredAt = null,
    ) {
        $aggregateReference = trim($aggregateReference);

        if ($aggregateReference === '') {
            throw new \InvalidArgumentException('Aggregate reference cannot be empty.');
        }

        $this->aggregateReference = $aggregateReference;
        $this->payload = $payload;
        $this->occurredAt = $occurredAt ?? new DateTimeImmutable();
    }

    public function aggregateReference(): string
    {
        return $this->aggregateReference;
    }

    public function payload(): array
    {
        return $this->payload;
    }

    public function occurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public function name(): string
    {
        return static::class;
    }
}
