<?php

declare(strict_types=1);

namespace App\Relating\Validator;

final readonly class RelationValidationResult implements \JsonSerializable
{
    /**
     * @param list<RelationValidationViolation> $violations
     */
    public function __construct(private array $violations = [])
    {
        foreach ($this->violations as $violation) {
            if (!$violation instanceof RelationValidationViolation) {
                throw new \InvalidArgumentException('Validation result accepts RelationValidationViolation items only.');
            }
        }
    }

    public static function pass(): self
    {
        return new self();
    }

    public static function fail(RelationValidationViolation $violation): self
    {
        return new self([$violation]);
    }

    /**
     * @return list<RelationValidationViolation>
     */
    public function violations(): array
    {
        return $this->violations;
    }

    public function isValid(): bool
    {
        return [] === $this->violations;
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

    public function withViolation(RelationValidationViolation $violation): self
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
