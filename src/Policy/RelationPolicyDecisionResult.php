<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Enum\RelationPolicyDecision;
use App\Relating\Enum\RelationPolicyFailureCode;

final readonly class RelationPolicyDecisionResult implements \JsonSerializable
{
    public function __construct(
        private RelationPolicyDecision $decision,
        private ?RelationPolicyFailureCode $failureCode = null,
        private ?string $message = null,
    ) {
        if (RelationPolicyDecision::Allowed === $this->decision && null !== $this->failureCode) {
            throw new \InvalidArgumentException('Allowed policy result cannot contain a failure code.');
        }
    }

    public static function allow(): self
    {
        return new self(RelationPolicyDecision::Allowed);
    }

    public static function deny(RelationPolicyFailureCode $code, string $message): self
    {
        return new self(RelationPolicyDecision::Denied, $code, $message);
    }

    public static function review(RelationPolicyFailureCode $code, string $message): self
    {
        return new self(RelationPolicyDecision::NeedsReview, $code, $message);
    }

    public function decision(): RelationPolicyDecision
    {
        return $this->decision;
    }

    public function allowed(): bool
    {
        return RelationPolicyDecision::Allowed === $this->decision;
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
