<?php

declare(strict_types=1);


namespace App\Value;

use InvalidArgumentException;

abstract readonly class PercentageValue extends AbstractIntValue
{
    protected function assertValid(int $value): void
    {
        if ($value < 0 || $value > 100) {
            throw new InvalidArgumentException(static::class . ' must be between 0 and 100.');
        }
    }
}
