<?php

declare(strict_types=1);

namespace App\Relating\ValueObject\Trace;

use App\Relating\Enum\RelationTraceSubjectKind;

final readonly class RelationTraceSubjectReference implements \JsonSerializable
{
    public function __construct(
        private RelationTraceSubjectKind $kind,
        private string $reference,
    ) {
        if ('' === trim($reference)) {
            throw new \InvalidArgumentException('Trace subject reference cannot be empty.');
        }
    }

    public function kind(): RelationTraceSubjectKind
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
        ];
    }
}
