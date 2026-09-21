<?php

declare(strict_types=1);

namespace App\Relating\Validator;

use App\Relating\Enum\RelationValidationSeverity;

final readonly class RelationValidationViolation implements \JsonSerializable
{
    public function __construct(
        private string $path,
        private string $message,
        private RelationValidationSeverity $severity = RelationValidationSeverity::Error,
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

    public function severity(): RelationValidationSeverity
    {
        return $this->severity;
    }

    public function code(): ?string
    {
        return $this->code;
    }

    public function isBlocking(): bool
    {
        return RelationValidationSeverity::Blocking === $this->severity;
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
        if ('' === trim($value)) {
            throw new \InvalidArgumentException($label.' cannot be empty.');
        }
    }
}
