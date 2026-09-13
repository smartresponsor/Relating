<?php

declare(strict_types=1);

namespace App\ValueObject;

abstract readonly class AbstractStringValue implements \JsonSerializable, \Stringable
{
    public function __construct(private string $value)
    {
        $value = trim($value);

        if ('' === $value) {
            throw new \InvalidArgumentException(static::class.' cannot be empty.');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return static::class === $other::class && $this->value === $other->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
