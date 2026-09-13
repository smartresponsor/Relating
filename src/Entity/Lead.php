<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\LeadConversionStatus;
use App\Enum\LeadStatus;
use App\Enum\LeadTemperature;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_lead')]
#[ORM\Index(columns: ['tenant_reference', 'status'], name: 'idx_relating_lead_tenant_status')]
#[ORM\Index(columns: ['email'], name: 'idx_relating_lead_email')]
#[ORM\Index(columns: ['source_reference'], name: 'idx_relating_lead_source')]
#[ORM\Index(columns: ['relationship_reference'], name: 'idx_relating_lead_relationship')]
final class Lead extends AbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 64)]
    private string $status;

    #[ORM\Column(type: 'string', length: 64)]
    private string $temperature;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $displayName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $companyName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $sourceReference = null;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $relationshipReference = null;

    #[ORM\Column(type: 'integer')]
    private int $score = 0;

    #[ORM\Column(type: 'string', length: 64)]
    private string $conversionStatus;

    #[ORM\Column(type: 'json')]
    private array $payload = [];

    public function __construct(string $id, array $payload = [])
    {
        $this->bootEntity($id);
        $this->status = LeadStatus::Captured->value;
        $this->temperature = LeadTemperature::Cold->value;
        $this->conversionStatus = LeadConversionStatus::Pending->value;
        $this->payload = $payload;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function score(): int
    {
        return $this->score;
    }

    public function payload(): array
    {
        return $this->payload;
    }

    public function identify(?string $displayName, ?string $companyName, ?string $email, ?string $phone): void
    {
        $this->displayName = $this->nullableText($displayName);
        $this->companyName = $this->nullableText($companyName);
        $this->email = $this->nullableText($email);
        $this->phone = $this->nullableText($phone, 64);
        $this->touch();
    }

    public function setSourceReference(?string $sourceReference): void
    {
        $this->sourceReference = $this->nullableText($sourceReference, 128);
        $this->touch();
    }

    public function qualify(int $score, LeadTemperature $temperature): void
    {
        $this->score = $this->scoreValue($score, 'Lead score');
        $this->temperature = $temperature->value;
        $this->status = LeadStatus::Qualified->value;
        $this->touch();
    }

    public function disqualify(string $reason): void
    {
        $payload = $this->payload;
        $payload['disqualification_reason'] = $this->requiredText($reason, 'Disqualification reason', 500);
        $this->payload = $payload;
        $this->status = LeadStatus::Disqualified->value;
        $this->touch();
    }

    public function linkRelationship(string $relationshipReference): void
    {
        $this->relationshipReference = $this->requiredText($relationshipReference, 'Relationship reference', 128);
        $this->conversionStatus = LeadConversionStatus::LinkedToVendor->value;
        $this->touch();
    }

    public function markConverted(?string $relationshipReference = null): void
    {
        if (null !== $relationshipReference) {
            $this->relationshipReference = $this->requiredText($relationshipReference, 'Relationship reference', 128);
        }

        $this->status = LeadStatus::Converted->value;
        $this->conversionStatus = LeadConversionStatus::Completed->value;
        $this->touch();
    }

    public function markDuplicate(string $duplicateReference): void
    {
        $payload = $this->payload;
        $payload['duplicate_reference'] = $this->requiredText($duplicateReference, 'Duplicate reference', 128);
        $this->payload = $payload;
        $this->status = LeadStatus::Duplicate->value;
        $this->touch();
    }

    public function replacePayload(array $payload): void
    {
        $this->payload = $payload;
        $this->touch();
    }
}
