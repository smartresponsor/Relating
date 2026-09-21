<?php

declare(strict_types=1);

namespace App\Relating\ValueObject\Trace;

use App\Relating\Enum\RelationTraceActorKind;

final readonly class RelationTraceActorReference implements \JsonSerializable
{
    public function __construct(
        private RelationTraceActorKind $kind,
        private string $reference,
        private ?string $label = null,
    ) {
        if ('' === trim($reference)) {
            throw new \InvalidArgumentException('Trace actor reference cannot be empty.');
        }
    }

    public function kind(): RelationTraceActorKind
    {
        return $this->kind;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function jsonSerialize(): array
    {
        return [
            'kind' => $this->kind->value,
            'reference' => $this->reference,
            'label' => $this->label,
        ];
    }
}
