<?php

declare(strict_types=1);

namespace App\Validation;

use App\Enum\ValidationSeverity;
use JsonSerializable;

final readonly class ValidationViolation implements JsonSerializable
{
    public function __construct(
        private string $path,
        private string $message,
        private ValidationSeverity $severity = ValidationSeverity::Error,
        private ?string $code = null,
    ) {
        self::assertFilled($this->path, 'Violation path');
        self::assertFilled($this->message, 'Violation message');
    }

    public function path(): string
    {
        return $this->path;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function severity(): ValidationSeverity
    {
        return $this->severity;
    }

    public function code(): ?string
    {
        return $this->code;
    }

    public function isBlocking(): bool
    {
        return $this->severity === ValidationSeverity::Blocking;
    }

    public function jsonSerialize(): array
    {
        return [
            'path' => $this->path,
            'message' => $this->message,
            'severity' => $this->severity->value,
            'code' => $this->code,
        ];
    }

    private static function assertFilled(string $value, string $label): void
    {
        if (trim($value) === '') {
            throw new \InvalidArgumentException($label . ' cannot be empty.');
        }
    }
}
