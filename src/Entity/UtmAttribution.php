<?php

declare(strict_types=1);


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_utm_attribution')]
class UtmAttribution extends AbstractNamedRelatingEntity
{
}
