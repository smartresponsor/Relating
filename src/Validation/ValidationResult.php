<?php

declare(strict_types=1);

namespace App\Validation;

use JsonSerializable;

final readonly class ValidationResult implements JsonSerializable
{
    /**
     * @param list<ValidationViolation> $violations
     */
    public function __construct(private array $violations = [])
    {
        foreach ($this->violations as $violation) {
            if (!$violation instanceof ValidationViolation) {
                throw new \InvalidArgumentException('Validation result accepts ValidationViolation items only.');
            }
        }
    }

    public static function pass(): self
    {
        return new self();
    }

    public static function fail(ValidationViolation $violation): self
    {
        return new self([$violation]);
    }

    /**
     * @return list<ValidationViolation>
     */
    public function violations(): array
    {
        return $this->violations;
    }

    public function isValid(): bool
    {
        return $this->violations === [];
    }

    public function hasBlockingViolation(): bool
    {
        foreach ($this->violations as $violation) {
            if ($violation->isBlocking()) {
                return true;
            }
        }

        return false;
    }

    public function withViolation(ValidationViolation $violation): self
    {
        return new self([...$this->violations, $violation]);
    }

    public function merge(self $other): self
    {
        return new self([...$this->violations, ...$other->violations]);
    }

    public function jsonSerialize(): array
    {
        return [
            'valid' => $this->isValid(),
            'blocking' => $this->hasBlockingViolation(),
            'violations' => $this->violations,
        ];
    }
}
