<?php

declare(strict_types=1);

namespace App\Relating\DataFixtures;

use App\Relating\Enum\RelationDemoScenarioKind;

final readonly class RelationRelatingDemoScenario implements \JsonSerializable
{
    /**
     * @param list<string>         $businessOperations
     * @param array<string, mixed> $payload
     */
    public function __construct(
        public RelationDemoScenarioKind $kind,
        public string $title,
        public string $businessGoal,
        public array $businessOperations,
        public array $payload = [],
    ) {
        if ('' === trim($this->title)) {
            throw new \InvalidArgumentException('Demo scenario title cannot be empty.');
        }

        if ('' === trim($this->businessGoal)) {
            throw new \InvalidArgumentException('Demo scenario business goal cannot be empty.');
        }

        foreach ($this->businessOperations as $operation) {
            if ('' === trim($operation)) {
                throw new \InvalidArgumentException('Demo scenario business operation cannot be empty.');
            }

            if (1 === preg_match('/^(index|create|read|update|delete|list|show|edit)$/i', $operation)) {
                throw new \InvalidArgumentException('Demo scenario cannot use CRUD operation name: '.$operation);
            }
        }
    }

    /**
     * @return array{kind: string, title: string, businessGoal: string, businessOperations: list<string>, payload: array<string, mixed>}
     */
    public function jsonSerialize(): array
    {
        return [
            'kind' => $this->kind->value,
            'title' => $this->title,
            'businessGoal' => $this->businessGoal,
            'businessOperations' => $this->businessOperations,
            'payload' => $this->payload,
        ];
    }
}
