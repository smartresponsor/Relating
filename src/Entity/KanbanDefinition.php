<?php

declare(strict_types=1);


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_kanban_definition')]
class KanbanDefinition extends AbstractNamedRelatingEntity
{
}
