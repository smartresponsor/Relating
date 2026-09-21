<?php

declare(strict_types=1);

namespace App\Relating\ValueObject;

use App\Relating\Enum\RelationNeighborComponent;

final readonly class RelationNeighborSignalEnvelope implements \JsonSerializable
{
    private RelationNeighborComponent $sourceComponent;
    private string $signalKind;
    private ?string $sourceReference;
    private ?string $relationshipReference;

    /**
     * @var array<string, mixed>
     */
    private array $payload;

    /**
     * @param array<string, mixed> $payload
     */
    public function __construct(
        RelationNeighborComponent $sourceComponent,
        string $signalKind,
        ?string $sourceReference,
        ?string $relationshipReference,
        array $payload = [],
    ) {
        $signalKind = trim($signalKind);

        if ('' === $signalKind) {
            throw new \InvalidArgumentException('Neighbor signal kind cannot be empty.');
        }

        if (!preg_match('/^[a-z][a-z0-9_.]*$/', $signalKind)) {
            throw new \InvalidArgumentException('Neighbor signal kind must be a lowercase business signal code.');
        }

        $this->sourceComponent = $sourceComponent;
        $this->signalKind = $signalKind;
        $this->sourceReference = $this->normalizeNullable($sourceReference, 'RelationSource reference');
        $this->relationshipReference = $this->normalizeNullable($relationshipReference, 'Relationship reference');
        $this->payload = $payload;
    }

    public function sourceComponent(): RelationNeighborComponent
    {
        return $this->sourceComponent;
    }

    public function signalKind(): string
    {
        return $this->signalKind;
    }

    public function sourceReference(): ?string
    {
        return $this->sourceReference;
    }

    public function relationshipReference(): ?string
    {
        return $this->relationshipReference;
    }

    /**
     * @return array<string, mixed>
     */
    public function payload(): array
    {
        return $this->payload;
    }

    /**
     * @return array{sourceComponent: string, signalKind: string, sourceReference: ?string, relationshipReference: ?string, payload: array<string, mixed>}
     */
    public function jsonSerialize(): array
    {
        return [
            'sourceComponent' => $this->sourceComponent->value,
            'signalKind' => $this->signalKind,
            'sourceReference' => $this->sourceReference,
            'relationshipReference' => $this->relationshipReference,
            'payload' => $this->payload,
        ];
    }

    private function normalizeNullable(?string $value, string $label): ?string
    {
        if (null === $value) {
            return null;
        }

        $value = trim($value);

        if ('' === $value) {
            return null;
        }

        if (mb_strlen($value) > 128) {
            throw new \InvalidArgumentException($label.' cannot exceed 128 characters.');
        }

        return $value;
    }
}
