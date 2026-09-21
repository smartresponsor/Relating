<?php

declare(strict_types=1);

namespace App\Relating\Validator;

final readonly class RelationPayloadSchema implements \JsonSerializable
{
    /**
     * @param list<RelationPayloadFieldRule> $fields
     */
    public function __construct(private string $businessAction, private array $fields)
    {
        if ('' === trim($this->businessAction)) {
            throw new \InvalidArgumentException('Business action cannot be empty.');
        }

        foreach ($this->fields as $field) {
            if (!$field instanceof RelationPayloadFieldRule) {
                throw new \InvalidArgumentException('Payload schema accepts RelationPayloadFieldRule items only.');
            }
        }
    }

    public function businessAction(): string
    {
        return $this->businessAction;
    }

    /**
     * @return list<RelationPayloadFieldRule>
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
