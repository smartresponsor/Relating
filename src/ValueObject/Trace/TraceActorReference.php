<?php

declare(strict_types=1);

namespace App\ValueObject\Trace;

use App\Enum\TraceActorKind;

final readonly class TraceActorReference implements \JsonSerializable
{
    public function __construct(
        private TraceActorKind $kind,
        private string $reference,
        private ?string $label = null,
    ) {
        if ('' === trim($reference)) {
            throw new \InvalidArgumentException('Trace actor reference cannot be empty.');
        }
    }

    public function kind(): TraceActorKind
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
