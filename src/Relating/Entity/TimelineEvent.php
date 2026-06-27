<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use App\Relating\Enum\TimelineEventKind;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_timeline_event')]
#[ORM\Index(columns: ['tenant_reference', 'target_type', 'target_reference'], name: 'idx_relating_timeline_tenant_target')]
#[ORM\Index(columns: ['relationship_reference'], name: 'idx_relating_timeline_relationship')]
#[ORM\Index(columns: ['event_type'], name: 'idx_relating_timeline_event_type')]
#[ORM\Index(columns: ['occurred_at'], name: 'idx_relating_timeline_occurred')]
final class TimelineEvent extends AbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 64)]
    private string $targetType;

    #[ORM\Column(type: 'string', length: 128)]
    private string $targetReference;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $relationshipReference = null;

    #[ORM\Column(type: 'string', length: 128)]
    private string $eventType;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $sourceComponent = null;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $sourceReference = null;

    #[ORM\Column(type: 'json')]
    private array $payload = [];

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $occurredAt;

    public function __construct(string $id, string $targetType, string $targetReference, TimelineEventKind $eventType, array $payload = [], ?DateTimeImmutable $occurredAt = null)
    {
        $this->bootEntity($id);
        $this->targetType = $this->requiredCode($targetType, 'Target type');
        $this->targetReference = $this->requiredText($targetReference, 'Target reference', 128);
        $this->eventType = $eventType->value;
        $this->payload = $payload;
        $this->occurredAt = $occurredAt ?? new DateTimeImmutable();
    }

    public function payload(): array
    {
        return $this->payload;
    }

    public function occurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public function attachRelationship(?string $relationshipReference): void
    {
        $this->relationshipReference = $this->nullableText($relationshipReference, 128);
        $this->touch();
    }

    public function attachSource(?string $sourceComponent, ?string $sourceReference): void
    {
        $this->sourceComponent = $this->nullableText($sourceComponent, 64);
        $this->sourceReference = $this->nullableText($sourceReference, 128);
        $this->touch();
    }
}
