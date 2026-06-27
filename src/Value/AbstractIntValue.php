<?php

declare(strict_types=1);


namespace App\Value;

use InvalidArgumentException;
use JsonSerializable;

abstract readonly class AbstractIntValue implements JsonSerializable
{
    public function __construct(private int $value)
    {
        $this->assertValid($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function jsonSerialize(): int
    {
        return $this->value;
    }

    protected function assertValid(int $value): void
    {
        if ($value < 0) {
            throw new InvalidArgumentException(static::class . ' cannot be negative.');
        }
    }
}
