<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\RelationshipKind;
use App\Enum\RelationshipLifecycleStage;
use App\Enum\RelationshipStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_relationship')]
#[ORM\Index(columns: ['tenant_reference', 'vendor_reference'], name: 'idx_relating_relationship_tenant_vendor')]
#[ORM\Index(columns: ['kind'], name: 'idx_relating_relationship_kind')]
#[ORM\Index(columns: ['status'], name: 'idx_relating_relationship_status')]
#[ORM\Index(columns: ['lifecycle_stage'], name: 'idx_relating_relationship_lifecycle')]
#[ORM\Index(columns: ['owner_reference'], name: 'idx_relating_relationship_owner')]
#[ORM\Index(columns: ['next_action_at'], name: 'idx_relating_relationship_next_action')]
final class Relationship extends AbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 128)]
    private string $vendorReference;

    #[ORM\Column(type: 'string', length: 64)]
    private string $kind;

    #[ORM\Column(type: 'string', length: 64)]
    private string $status;

    #[ORM\Column(type: 'string', length: 64)]
    private string $lifecycleStage;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $ownerReference = null;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $sourceReference = null;

    #[ORM\Column(type: 'integer')]
    private int $healthScore = 0;

    #[ORM\Column(type: 'integer')]
    private int $engagementScore = 0;

    #[ORM\Column(type: 'integer')]
    private int $fitScore = 0;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $firstTouchAt = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $lastTouchAt = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $nextActionAt = null;

    #[ORM\Column(type: 'json')]
    private array $context = [];

    public function __construct(string $id, string $vendorReference, RelationshipKind $kind = RelationshipKind::Prospect)
    {
        $this->bootEntity($id);
        $this->vendorReference = $this->requiredText($vendorReference, 'Vendor reference', 128);
        $this->kind = $kind->value;
        $this->status = RelationshipStatus::Active->value;
        $this->lifecycleStage = RelationshipLifecycleStage::New->value;
    }

    public function vendorReference(): string
    {
        return $this->vendorReference;
    }

    public function kind(): string
    {
        return $this->kind;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function lifecycleStage(): string
    {
        return $this->lifecycleStage;
    }

    public function ownerReference(): ?string
    {
        return $this->ownerReference;
    }

    public function context(): array
    {
        return $this->context;
    }

    public function reclassify(RelationshipKind $kind): void
    {
        $this->kind = $kind->value;
        $this->touch();
    }

    public function transitionStatus(RelationshipStatus $status): void
    {
        $this->status = $status->value;
        $this->touch();
    }

    public function transitionLifecycle(RelationshipLifecycleStage $stage): void
    {
        $this->lifecycleStage = $stage->value;
        $this->touch();
    }

    public function assignOwner(?string $ownerReference): void
    {
        $this->ownerReference = $this->nullableText($ownerReference, 128);
        $this->touch();
    }

    public function setSourceReference(?string $sourceReference): void
    {
        $this->sourceReference = $this->nullableText($sourceReference, 128);
        $this->touch();
    }

    public function updateScores(int $healthScore, int $engagementScore, int $fitScore): void
    {
        $this->healthScore = $this->scoreValue($healthScore, 'Health score');
        $this->engagementScore = $this->scoreValue($engagementScore, 'Engagement score');
        $this->fitScore = $this->scoreValue($fitScore, 'Fit score');
        $this->touch();
    }

    public function markTouch(?\DateTimeImmutable $at = null): void
    {
        $at ??= new \DateTimeImmutable();
        $this->firstTouchAt ??= $at;
        $this->lastTouchAt = $at;
        $this->touch();
    }

    public function planNextAction(?\DateTimeImmutable $at): void
    {
        $this->nextActionAt = $at;
        $this->touch();
    }

    public function replaceContext(array $context): void
    {
        $this->context = $context;
        $this->touch();
    }
}
