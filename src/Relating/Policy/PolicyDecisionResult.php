<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Enum\PolicyDecision;
use App\Relating\Enum\PolicyFailureCode;
use JsonSerializable;

final readonly class PolicyDecisionResult implements JsonSerializable
{
    public function __construct(
        private PolicyDecision $decision,
        private ?PolicyFailureCode $failureCode = null,
        private ?string $message = null,
    ) {
        if ($this->decision === PolicyDecision::Allowed && $this->failureCode !== null) {
            throw new \InvalidArgumentException('Allowed policy result cannot contain a failure code.');
        }
    }

    public static function allow(): self
    {
        return new self(PolicyDecision::Allowed);
    }

    public static function deny(PolicyFailureCode $code, string $message): self
    {
        return new self(PolicyDecision::Denied, $code, $message);
    }

    public static function review(PolicyFailureCode $code, string $message): self
    {
        return new self(PolicyDecision::NeedsReview, $code, $message);
    }

    public function decision(): PolicyDecision
    {
        return $this->decision;
    }

    public function allowed(): bool
    {
        return $this->decision === PolicyDecision::Allowed;
    }

    public function jsonSerialize(): array
    {
        return [
            'decision' => $this->decision->value,
            'failureCode' => $this->failureCode?->value,
            'message' => $this->message,
        ];
    }
}
