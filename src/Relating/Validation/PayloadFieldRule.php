<?php

declare(strict_types=1);

namespace App\Relating\Validation;

use App\Relating\Enum\PayloadFieldType;
use JsonSerializable;

final readonly class PayloadFieldRule implements JsonSerializable
{
    /**
     * @param list<string> $allowedValues
     */
    public function __construct(
        private string $name,
        private PayloadFieldType $type,
        private bool $required = false,
        private ?int $maxLength = null,
        private array $allowedValues = [],
    ) {
        if (trim($this->name) === '') {
            throw new \InvalidArgumentException('Payload field name cannot be empty.');
        }

        if ($this->maxLength !== null && $this->maxLength < 1) {
            throw new \InvalidArgumentException('Payload max length must be positive.');
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): PayloadFieldType
    {
        return $this->type;
    }

    public function required(): bool
    {
        return $this->required;
    }

    public function maxLength(): ?int
    {
        return $this->maxLength;
    }

    /**
     * @return list<string>
     */
    public function allowedValues(): array
    {
        return $this->allowedValues;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type->value,
            'required' => $this->required,
            'maxLength' => $this->maxLength,
            'allowedValues' => $this->allowedValues,
        ];
    }
}
