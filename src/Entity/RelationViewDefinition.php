<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_view_definition')]
class RelationViewDefinition extends RelationAbstractNamedRelatingEntity
{
}
