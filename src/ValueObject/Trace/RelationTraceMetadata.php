<?php

declare(strict_types=1);

namespace App\Relating\ValueObject\Trace;

final readonly class RelationTraceMetadata implements \JsonSerializable
{
    /** @param array<string, scalar|null> $values */
    public function __construct(private array $values = [])
    {
        foreach ($values as $key => $value) {
            if (!\is_string($key) || '' === trim($key)) {
                throw new \InvalidArgumentException('Trace metadata keys must be non-empty strings.');
            }

            if (!\is_scalar($value) && null !== $value) {
                throw new \InvalidArgumentException('Trace metadata values must be scalar or null.');
            }
        }
    }

    /** @return array<string, scalar|null> */
    public function values(): array
    {
        return $this->values;
    }

    public function jsonSerialize(): array
    {
        return $this->values;
    }
}
