<?php

declare(strict_types=1);

namespace App\Relating\ValueObject;

use App\Relating\Enum\RelationNeighborComponent;
use App\Relating\Enum\RelationNeighborReferenceKind;

final readonly class RelationNeighborReference implements \JsonSerializable, \Stringable
{
    private RelationNeighborComponent $component;
    private RelationNeighborReferenceKind $kind;
    private string $reference;

    public function __construct(RelationNeighborComponent $component, RelationNeighborReferenceKind $kind, string $reference)
    {
        $reference = trim($reference);

        if ('' === $reference) {
            throw new \InvalidArgumentException('Neighbor reference cannot be empty.');
        }

        if (mb_strlen($reference) > 128) {
            throw new \InvalidArgumentException('Neighbor reference cannot exceed 128 characters.');
        }

        $this->component = $component;
        $this->kind = $kind;
        $this->reference = $reference;
    }

    public function component(): RelationNeighborComponent
    {
        return $this->component;
    }

    public function kind(): RelationNeighborReferenceKind
    {
        return $this->kind;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function key(): string
    {
        return $this->component->value.':'.$this->kind->value.':'.$this->reference;
    }

    public function matchesComponent(RelationNeighborComponent $component): bool
    {
        return $this->component === $component;
    }

    /**
     * @return array{component: string, kind: string, reference: string}
     */
    public function jsonSerialize(): array
    {
        return [
            'component' => $this->component->value,
            'kind' => $this->kind->value,
            'reference' => $this->reference,
        ];
    }

    public function __toString(): string
    {
        return $this->key();
    }
}
