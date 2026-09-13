<?php

declare(strict_types=1);

namespace App\ValueObject;

final readonly class MoneyAmount implements \JsonSerializable
{
    public function __construct(
        private string $currency,
        private int $minorAmount,
    ) {
        $currency = strtoupper(trim($currency));

        if (!preg_match('/^[A-Z]{3}$/', $currency)) {
            throw new \InvalidArgumentException('Currency must be ISO-4217 compatible.');
        }

        if ($minorAmount < 0) {
            throw new \InvalidArgumentException('Money amount cannot be negative.');
        }

        $this->currency = $currency;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function minorAmount(): int
    {
        return $this->minorAmount;
    }

    public function jsonSerialize(): array
    {
        return [
            'currency' => $this->currency,
            'minorAmount' => $this->minorAmount,
        ];
    }
}
