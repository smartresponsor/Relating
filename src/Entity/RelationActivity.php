<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use App\Relating\Enum\RelationActivityDirection;
use App\Relating\Enum\RelationActivityStatus;
use App\Relating\Enum\RelationActivityType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_activity')]
#[ORM\Index(columns: ['tenant_reference', 'target_type', 'target_reference'], name: 'idx_relating_activity_tenant_target')]
#[ORM\Index(columns: ['relationship_reference'], name: 'idx_relating_activity_relationship')]
#[ORM\Index(columns: ['status'], name: 'idx_relating_activity_status')]
#[ORM\Index(columns: ['due_at'], name: 'idx_relating_activity_due')]
final class RelationActivity extends RelationAbstractRelatingEntity
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

    public function __construct(string $id, RelationActivityType $type, string $targetType, string $targetReference, RelationActivityDirection $direction = RelationActivityDirection::Internal)
    {
        $this->bootEntity($id);
        $this->type = $type->value;
        $this->status = RelationActivityStatus::Planned->value;
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
        $this->status = RelationActivityStatus::InProgress->value;
        $this->touch();
    }

    public function complete(?\DateTimeImmutable $completedAt = null): void
    {
        $this->status = RelationActivityStatus::Completed->value;
        $this->completedAt = $completedAt ?? new \DateTimeImmutable();
        $this->touch();
    }

    public function cancel(): void
    {
        $this->status = RelationActivityStatus::Cancelled->value;
        $this->touch();
    }
}
