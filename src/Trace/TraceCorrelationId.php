<?php

declare(strict_types=1);

namespace App\Trace;

use InvalidArgumentException;
use JsonSerializable;
use Stringable;

final readonly class TraceCorrelationId implements JsonSerializable, Stringable
{
    public function __construct(private string $value)
    {
        if (trim($value) === '') {
            throw new InvalidArgumentException('Trace correlation id cannot be empty.');
        }
    }

    public function value(): string
    {
        return $this->value;
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
