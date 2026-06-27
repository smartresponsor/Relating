<?php

declare(strict_types=1);


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_field_definition')]
class FieldDefinition extends AbstractNamedRelatingEntity
{
}
