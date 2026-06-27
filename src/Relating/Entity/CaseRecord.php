<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use App\Relating\Enum\CasePriority;
use App\Relating\Enum\CaseSlaStatus;
use App\Relating\Enum\CaseStatusCode;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_case_record')]
#[ORM\Index(columns: ['tenant_reference', 'relationship_reference'], name: 'idx_relating_case_tenant_relationship')]
#[ORM\Index(columns: ['status'], name: 'idx_relating_case_status')]
#[ORM\Index(columns: ['priority'], name: 'idx_relating_case_priority')]
#[ORM\Index(columns: ['sla_deadline_at'], name: 'idx_relating_case_sla_deadline')]
final class CaseRecord extends AbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 128)]
    private string $relationshipReference;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'string', length: 64)]
    private string $status;

    #[ORM\Column(type: 'string', length: 64)]
    private string $priority;

    #[ORM\Column(type: 'string', length: 64)]
    private string $slaStatus;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $slaDeadlineAt = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $resolvedAt = null;

    #[ORM\Column(type: 'json')]
    private array $context = [];

    public function __construct(string $id, string $relationshipReference, string $title, CasePriority $priority = CasePriority::Normal)
    {
        $this->bootEntity($id);
        $this->relationshipReference = $this->requiredText($relationshipReference, 'Relationship reference', 128);
        $this->title = $this->requiredText($title, 'Case title');
        $this->status = CaseStatusCode::Open->value;
        $this->priority = $priority->value;
        $this->slaStatus = CaseSlaStatus::NotStarted->value;
    }

    public function relationshipReference(): string
    {
        return $this->relationshipReference;
    }

    public function changeStatus(CaseStatusCode $status): void
    {
        $this->status = $status->value;
        $this->touch();
    }

    public function changePriority(CasePriority $priority): void
    {
        $this->priority = $priority->value;
        $this->touch();
    }

    public function startSla(?DateTimeImmutable $deadlineAt): void
    {
        $this->slaDeadlineAt = $deadlineAt;
        $this->slaStatus = CaseSlaStatus::Running->value;
        $this->touch();
    }

    public function markSlaBreached(): void
    {
        $this->slaStatus = CaseSlaStatus::Breached->value;
        $this->touch();
    }

    public function resolve(?DateTimeImmutable $resolvedAt = null): void
    {
        $this->status = CaseStatusCode::Resolved->value;
        $this->slaStatus = CaseSlaStatus::Satisfied->value;
        $this->resolvedAt = $resolvedAt ?? new DateTimeImmutable();
        $this->touch();
    }

    public function replaceContext(array $context): void
    {
        $this->context = $context;
        $this->touch();
    }
}
