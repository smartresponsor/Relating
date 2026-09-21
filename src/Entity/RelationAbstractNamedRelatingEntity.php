<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class RelationAbstractNamedRelatingEntity extends RelationAbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 128)]
    protected string $code;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected ?string $name = null;

    #[ORM\Column(type: 'json')]
    protected array $data = [];

    public function __construct(string $id, string $code, ?string $name = null, array $data = [])
    {
        $this->bootEntity($id);
        $this->code = $this->requiredCode($code, 'Code', 128);
        $this->name = $this->nullableText($name);
        $this->data = $data;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function rename(?string $name): void
    {
        $this->name = $this->nullableText($name);
        $this->touch();
    }

    public function replaceData(array $data): void
    {
        $this->data = $data;
        $this->touch();
    }
}
