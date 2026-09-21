<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_note')]
class RelationNote extends RelationAbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 64)]
    private string $targetType;

    #[ORM\Column(type: 'string', length: 128)]
    private string $targetReference;

    #[ORM\Column(type: 'text')]
    private string $body;

    public function __construct(string $id, string $targetType, string $targetReference, string $body)
    {
        $this->bootEntity($id);
        $this->targetType = $this->required($targetType, 'Target type');
        $this->targetReference = $this->required($targetReference, 'Target reference');
        $this->body = $this->required($body, 'RelationNote body');
    }

    public function body(): string
    {
        return $this->body;
    }

    public function revise(string $body): void
    {
        $this->body = $this->required($body, 'RelationNote body');
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
