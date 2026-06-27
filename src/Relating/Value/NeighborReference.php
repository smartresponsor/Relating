<?php

declare(strict_types=1);

namespace App\Relating\Value;

use App\Relating\Enum\NeighborComponent;
use App\Relating\Enum\NeighborReferenceKind;
use InvalidArgumentException;
use JsonSerializable;
use Stringable;

final readonly class NeighborReference implements JsonSerializable, Stringable
{
    private NeighborComponent $component;
    private NeighborReferenceKind $kind;
    private string $reference;

    public function __construct(NeighborComponent $component, NeighborReferenceKind $kind, string $reference)
    {
        $reference = trim($reference);

        if ($reference === '') {
            throw new InvalidArgumentException('Neighbor reference cannot be empty.');
        }

        if (mb_strlen($reference) > 128) {
            throw new InvalidArgumentException('Neighbor reference cannot exceed 128 characters.');
        }

        $this->component = $component;
        $this->kind = $kind;
        $this->reference = $reference;
    }

    public function component(): NeighborComponent
    {
        return $this->component;
    }

    public function kind(): NeighborReferenceKind
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

    public function matchesComponent(NeighborComponent $component): bool
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
