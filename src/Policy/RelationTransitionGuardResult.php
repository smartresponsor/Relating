<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Enum\RelationTransitionGuardOutcome;

final readonly class RelationTransitionGuardResult implements \JsonSerializable
{
    public function __construct(
        private RelationTransitionGuardOutcome $outcome,
        private ?string $reason = null,
    ) {
    }

    public static function pass(): self
    {
        return new self(RelationTransitionGuardOutcome::Pass);
    }

    public static function block(string $reason): self
    {
        return new self(RelationTransitionGuardOutcome::Block, $reason);
    }

    public static function review(string $reason): self
    {
        return new self(RelationTransitionGuardOutcome::Review, $reason);
    }

    public function outcome(): RelationTransitionGuardOutcome
    {
        return $this->outcome;
    }

    public function passed(): bool
    {
        return RelationTransitionGuardOutcome::Pass === $this->outcome;
    }

    public function jsonSerialize(): array
    {
        return [
            'outcome' => $this->outcome->value,
            'reason' => $this->reason,
        ];
    }
}
