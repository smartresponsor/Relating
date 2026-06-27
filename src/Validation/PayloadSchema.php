<?php

declare(strict_types=1);

namespace App\Validation;

use JsonSerializable;

final readonly class PayloadSchema implements JsonSerializable
{
    /**
     * @param list<PayloadFieldRule> $fields
     */
    public function __construct(private string $businessAction, private array $fields)
    {
        if (trim($this->businessAction) === '') {
            throw new \InvalidArgumentException('Business action cannot be empty.');
        }

        foreach ($this->fields as $field) {
            if (!$field instanceof PayloadFieldRule) {
                throw new \InvalidArgumentException('Payload schema accepts PayloadFieldRule items only.');
            }
        }
    }

    public function businessAction(): string
    {
        return $this->businessAction;
    }

    /**
     * @return list<PayloadFieldRule>
     */
    public function fields(): array
    {
        return $this->fields;
    }

    public function jsonSerialize(): array
    {
        return [
            'businessAction' => $this->businessAction,
            'fields' => $this->fields,
        ];
    }
}
