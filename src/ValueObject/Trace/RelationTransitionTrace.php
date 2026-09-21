<?php

declare(strict_types=1);

namespace App\Relating\ValueObject\Trace;

final readonly class RelationTransitionTrace implements \JsonSerializable
{
    public function __construct(
        private RelationTraceCorrelationId $correlationId,
        private RelationTraceSubjectReference $subject,
        private string $fromState,
        private string $toState,
        private RelationTraceActorReference $actor,
        private \DateTimeImmutable $transitionedAt,
        private RelationTraceMetadata $metadata = new RelationTraceMetadata(),
    ) {
        if ('' === trim($toState)) {
            throw new \InvalidArgumentException('Transition target state cannot be empty.');
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
            'transitionedAt' => $this->transitionedAt->format(\DATE_ATOM),
            'metadata' => $this->metadata,
        ];
    }
}
