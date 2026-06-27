<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class AbstractRelatingEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    protected string $id;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    protected ?string $tenantReference = null;

    #[ORM\Column(type: 'datetime_immutable')]
    protected DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    protected ?DateTimeImmutable $updatedAt = null;

    public function id(): string
    {
        return $this->id;
    }

    public function tenantReference(): ?string
    {
        return $this->tenantReference;
    }

    public function assignTenant(?string $tenantReference): void
    {
        $this->tenantReference = $this->nullableText($tenantReference);
        $this->touch();
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    protected function bootEntity(string $id): void
    {
        $this->id = $this->requiredText($id, 'Entity id');
        $this->createdAt = new DateTimeImmutable();
    }

    protected function touch(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    protected function requiredText(string $value, string $label, int $maxLength = 255): string
    {
        $value = trim($value);

        if ($value === '') {
            throw new \InvalidArgumentException($label . ' cannot be empty.');
        }

        if (mb_strlen($value) > $maxLength) {
            throw new \InvalidArgumentException($label . ' cannot exceed ' . $maxLength . ' characters.');
        }

        return $value;
    }

    protected function nullableText(?string $value, int $maxLength = 255): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);

        if ($value === '') {
            return null;
        }

        if (mb_strlen($value) > $maxLength) {
            throw new \InvalidArgumentException('Value cannot exceed ' . $maxLength . ' characters.');
        }

        return $value;
    }

    protected function requiredCode(string $value, string $label, int $maxLength = 64): string
    {
        $value = $this->requiredText($value, $label, $maxLength);

        if (!preg_match('/^[a-z][a-z0-9_]*$/', $value)) {
            throw new \InvalidArgumentException($label . ' must be a lowercase code.');
        }

        return $value;
    }

    protected function scoreValue(int $value, string $label): int
    {
        if ($value < 0 || $value > 100) {
            throw new \InvalidArgumentException($label . ' must be between 0 and 100.');
        }

        return $value;
    }

    protected function nonNegativeInt(int $value, string $label): int
    {
        if ($value < 0) {
            throw new \InvalidArgumentException($label . ' cannot be negative.');
        }

        return $value;
    }

    protected function isoCurrency(string $currency): string
    {
        $currency = strtoupper(trim($currency));

        if (!preg_match('/^[A-Z]{3}$/', $currency)) {
            throw new \InvalidArgumentException('Currency must be ISO-4217 compatible.');
        }

        return $currency;
    }

    protected function assertDateOrder(DateTimeImmutable $start, DateTimeImmutable $end, string $label): void
    {
        if ($end < $start) {
            throw new \InvalidArgumentException($label . ' end cannot be before start.');
        }
    }
}
