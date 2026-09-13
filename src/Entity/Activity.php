<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\ActivityDirection;
use App\Enum\ActivityStatus;
use App\Enum\ActivityType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_activity')]
#[ORM\Index(columns: ['tenant_reference', 'target_type', 'target_reference'], name: 'idx_relating_activity_tenant_target')]
#[ORM\Index(columns: ['relationship_reference'], name: 'idx_relating_activity_relationship')]
#[ORM\Index(columns: ['status'], name: 'idx_relating_activity_status')]
#[ORM\Index(columns: ['due_at'], name: 'idx_relating_activity_due')]
final class Activity extends AbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 64)]
    private string $type;

    #[ORM\Column(type: 'string', length: 64)]
    private string $status;

    #[ORM\Column(type: 'string', length: 64)]
    private string $direction;

    #[ORM\Column(type: 'string', length: 64)]
    private string $targetType;

    #[ORM\Column(type: 'string', length: 128)]
    private string $targetReference;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $relationshipReference = null;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $ownerReference = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $subject = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $body = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $dueAt = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $completedAt = null;

    public function __construct(string $id, ActivityType $type, string $targetType, string $targetReference, ActivityDirection $direction = ActivityDirection::Internal)
    {
        $this->bootEntity($id);
        $this->type = $type->value;
        $this->status = ActivityStatus::Planned->value;
        $this->targetType = $this->requiredCode($targetType, 'Target type');
        $this->targetReference = $this->requiredText($targetReference, 'Target reference', 128);
        $this->direction = $direction->value;
    }

    public function describe(?string $subject, ?string $body): void
    {
        $this->subject = $this->nullableText($subject);
        $this->body = $this->nullableText($body, 5000);
        $this->touch();
    }

    public function attachRelationship(?string $relationshipReference): void
    {
        $this->relationshipReference = $this->nullableText($relationshipReference, 128);
        $this->touch();
    }

    public function assignOwner(?string $ownerReference): void
    {
        $this->ownerReference = $this->nullableText($ownerReference, 128);
        $this->touch();
    }

    public function schedule(?\DateTimeImmutable $dueAt): void
    {
        $this->dueAt = $dueAt;
        $this->touch();
    }

    public function start(): void
    {
        $this->status = ActivityStatus::InProgress->value;
        $this->touch();
    }

    public function complete(?\DateTimeImmutable $completedAt = null): void
    {
        $this->status = ActivityStatus::Completed->value;
        $this->completedAt = $completedAt ?? new \DateTimeImmutable();
        $this->touch();
    }

    public function cancel(): void
    {
        $this->status = ActivityStatus::Cancelled->value;
        $this->touch();
    }
}
