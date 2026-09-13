<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\RelationshipSignalKind;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_relationship_signal')]
#[ORM\Index(columns: ['tenant_reference', 'relationship_reference'], name: 'idx_relating_signal_tenant_relationship')]
#[ORM\Index(columns: ['signal_type'], name: 'idx_relating_signal_type')]
#[ORM\Index(columns: ['source_component', 'source_reference'], name: 'idx_relating_signal_source')]
#[ORM\Index(columns: ['occurred_at'], name: 'idx_relating_signal_occurred')]
final class RelationshipSignal extends AbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 128)]
    private string $relationshipReference;

    #[ORM\Column(type: 'string', length: 64)]
    private string $signalType;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $sourceComponent;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $sourceReference;

    #[ORM\Column(type: 'integer')]
    private int $weight = 0;

    #[ORM\Column(type: 'json')]
    private array $payload;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $occurredAt;

    public function __construct(string $id, string $relationshipReference, RelationshipSignalKind $signalType, ?string $sourceComponent = null, ?string $sourceReference = null, array $payload = [], ?\DateTimeImmutable $occurredAt = null)
    {
        $this->bootEntity($id);
        $this->relationshipReference = $this->requiredText($relationshipReference, 'Relationship reference', 128);
        $this->signalType = $signalType->value;
        $this->sourceComponent = $this->nullableText($sourceComponent, 64);
        $this->sourceReference = $this->nullableText($sourceReference, 128);
        $this->payload = $payload;
        $this->occurredAt = $occurredAt ?? new \DateTimeImmutable();
    }

    public function relationshipReference(): string
    {
        return $this->relationshipReference;
    }

    public function signalType(): string
    {
        return $this->signalType;
    }

    public function sourceComponent(): ?string
    {
        return $this->sourceComponent;
    }

    public function sourceReference(): ?string
    {
        return $this->sourceReference;
    }

    public function payload(): array
    {
        return $this->payload;
    }

    public function occurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public function setWeight(int $weight): void
    {
        if ($weight < -100 || $weight > 100) {
            throw new \InvalidArgumentException('Signal weight must be between -100 and 100.');
        }

        $this->weight = $weight;
        $this->touch();
    }
}
