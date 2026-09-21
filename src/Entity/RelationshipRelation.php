<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_relationship_relation')]
#[ORM\Index(columns: ['source_relationship_reference'], name: 'idx_relating_relation_source')]
#[ORM\Index(columns: ['target_relationship_reference'], name: 'idx_relating_relation_target')]
class RelationshipRelation extends RelationAbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 36)]
    private string $sourceRelationshipReference;

    #[ORM\Column(type: 'string', length: 36)]
    private string $targetRelationshipReference;

    #[ORM\Column(type: 'string', length: 64)]
    private string $relationKind;

    public function __construct(string $id, string $sourceRelationshipReference, string $targetRelationshipReference, string $relationKind)
    {
        $this->bootEntity($id);
        $this->sourceRelationshipReference = $sourceRelationshipReference;
        $this->targetRelationshipReference = $targetRelationshipReference;
        $this->relationKind = $relationKind;
    }
}
