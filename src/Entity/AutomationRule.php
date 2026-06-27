<?php

declare(strict_types=1);


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_automation_rule')]
class AutomationRule extends AbstractNamedRelatingEntity
{
}
