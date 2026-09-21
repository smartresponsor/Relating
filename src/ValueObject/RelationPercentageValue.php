<?php

declare(strict_types=1);

namespace App\Relating\ValueObject;

abstract readonly class RelationPercentageValue extends RelationAbstractIntValue
{
    protected function assertValid(int $value): void
    {
        if ($value < 0 || $value > 100) {
            throw new \InvalidArgumentException(static::class.' must be between 0 and 100.');
        }
    }
}
