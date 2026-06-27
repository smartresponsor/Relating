<?php

declare(strict_types=1);

namespace App\Relating\Trace;

use DateTimeImmutable;
use InvalidArgumentException;
use JsonSerializable;

final readonly class TransitionTrace implements JsonSerializable
{
    public function __construct(
        private TraceCorrelationId $correlationId,
        private TraceSubjectReference $subject,
        private string $fromState,
        private string $toState,
        private TraceActorReference $actor,
        private DateTimeImmutable $transitionedAt,
        private TraceMetadata $metadata = new TraceMetadata(),
    ) {
        if (trim($toState) === '') {
            throw new InvalidArgumentException('Transition target state cannot be empty.');
        }
    }

    public function jsonSerialize(): array
    {
        return [
            'correlationId' => $this->correlationId->value(),
            'subject' => $this->subject,
            'fromState' => $this->fromState,
            'toState' => $this->toState,
            'actor' => $this->actor,
            'transitionedAt' => $this->transitionedAt->format(DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
