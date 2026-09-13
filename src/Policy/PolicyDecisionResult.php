<?php

declare(strict_types=1);

namespace App\Policy;

use App\Enum\PolicyDecision;
use App\Enum\PolicyFailureCode;

final readonly class PolicyDecisionResult implements \JsonSerializable
{
    public function __construct(
        private PolicyDecision $decision,
        private ?PolicyFailureCode $failureCode = null,
        private ?string $message = null,
    ) {
        if (PolicyDecision::Allowed === $this->decision && null !== $this->failureCode) {
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
        return PolicyDecision::Allowed === $this->decision;
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
