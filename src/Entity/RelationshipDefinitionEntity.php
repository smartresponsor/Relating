<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_relationship_definition')]
class RelationshipDefinitionEntity extends RelationAbstractNamedRelatingEntity
{
}
