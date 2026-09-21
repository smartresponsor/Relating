<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_task')]
class RelationTask extends RelationAbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 128)]
    private string $activityReference;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'string', length: 64)]
    private string $status;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $dueAt = null;

    public function __construct(string $id, string $activityReference, string $title, string $status)
    {
        $this->bootEntity($id);
        $this->activityReference = $this->required($activityReference, 'RelationActivity reference');
        $this->title = $this->required($title, 'RelationTask title');
        $this->status = $this->required($status, 'RelationTask status');
    }

    public function schedule(?\DateTimeImmutable $dueAt): void
    {
        $this->dueAt = $dueAt;
        $this->touch();
    }

    private function required(string $value, string $label): string
    {
        $value = trim($value);

        if ('' === $value) {
            throw new \InvalidArgumentException($label.' cannot be empty.');
        }

        return $value;
    }
}
