<?php

declare(strict_types=1);


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_contact_point_snapshot')]
class ContactPointSnapshot extends AbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 64)]
    private string $ownerType;

    #[ORM\Column(type: 'string', length: 128)]
    private string $ownerReference;

    #[ORM\Column(type: 'json')]
    private array $contactPoints;

    public function __construct(string $id, string $ownerType, string $ownerReference, array $contactPoints)
    {
        $this->bootEntity($id);
        $this->ownerType = $ownerType;
        $this->ownerReference = $ownerReference;
        $this->contactPoints = $contactPoints;
    }

    public function contactPoints(): array
    {
        return $this->contactPoints;
    }
}
