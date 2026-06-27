<?php

declare(strict_types=1);

namespace App\Trace;

use App\Enum\TraceSubjectKind;
use InvalidArgumentException;
use JsonSerializable;

final readonly class TraceSubjectReference implements JsonSerializable
{
    public function __construct(
        private TraceSubjectKind $kind,
        private string $reference,
    ) {
        if (trim($reference) === '') {
            throw new InvalidArgumentException('Trace subject reference cannot be empty.');
        }
    }

    public function kind(): TraceSubjectKind
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
