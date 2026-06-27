<?php

declare(strict_types=1);

namespace App\Policy;

use App\Enum\TransitionGuardOutcome;
use JsonSerializable;

final readonly class TransitionGuardResult implements JsonSerializable
{
    public function __construct(
        private TransitionGuardOutcome $outcome,
        private ?string $reason = null,
    ) {
    }

    public static function pass(): self
    {
        return new self(TransitionGuardOutcome::Pass);
    }

    public static function block(string $reason): self
    {
        return new self(TransitionGuardOutcome::Block, $reason);
    }

    public static function review(string $reason): self
    {
        return new self(TransitionGuardOutcome::Review, $reason);
    }

    public function outcome(): TransitionGuardOutcome
    {
        return $this->outcome;
    }

    public function passed(): bool
    {
        return $this->outcome === TransitionGuardOutcome::Pass;
    }

    public function jsonSerialize(): array
    {
        return [
            'outcome' => $this->outcome->value,
            'reason' => $this->reason,
        ];
    }
}
