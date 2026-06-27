<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\RelationshipParticipantRole;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_relationship_participant')]
#[ORM\Index(columns: ['tenant_reference', 'relationship_reference'], name: 'idx_relating_participant_tenant_relationship')]
#[ORM\Index(columns: ['vendor_reference'], name: 'idx_relating_participant_vendor')]
#[ORM\Index(columns: ['role'], name: 'idx_relating_participant_role')]
final class RelationshipParticipant extends AbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 128)]
    private string $relationshipReference;

    #[ORM\Column(type: 'string', length: 128)]
    private string $vendorReference;

    #[ORM\Column(type: 'string', length: 64)]
    private string $role;

    #[ORM\Column(type: 'boolean')]
    private bool $primaryParticipant;

    #[ORM\Column(type: 'json')]
    private array $context = [];

    public function __construct(string $id, string $relationshipReference, string $vendorReference, RelationshipParticipantRole $role, bool $primaryParticipant = false)
    {
        $this->bootEntity($id);
        $this->relationshipReference = $this->requiredText($relationshipReference, 'Relationship reference', 128);
        $this->vendorReference = $this->requiredText($vendorReference, 'Vendor reference', 128);
        $this->role = $role->value;
        $this->primaryParticipant = $primaryParticipant;
    }

    public function relationshipReference(): string
    {
        return $this->relationshipReference;
    }

    public function vendorReference(): string
    {
        return $this->vendorReference;
    }

    public function role(): string
    {
        return $this->role;
    }

    public function isPrimaryParticipant(): bool
    {
        return $this->primaryParticipant;
    }

    public function changeRole(RelationshipParticipantRole $role): void
    {
        $this->role = $role->value;
        $this->touch();
    }

    public function markPrimary(bool $primaryParticipant = true): void
    {
        $this->primaryParticipant = $primaryParticipant;
        $this->touch();
    }

    public function replaceContext(array $context): void
    {
        $this->context = $context;
        $this->touch();
    }
}
