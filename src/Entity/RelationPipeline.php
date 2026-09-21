<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_pipeline')]
#[ORM\Index(columns: ['tenant_reference', 'code'], name: 'idx_relating_pipeline_tenant_code')]
final class RelationPipeline extends RelationAbstractNamedRelatingEntity
{
    #[ORM\Column(type: 'boolean')]
    private bool $defaultPipeline = false;

    #[ORM\Column(type: 'boolean')]
    private bool $active = true;

    public function markDefault(bool $defaultPipeline): void
    {
        $this->defaultPipeline = $defaultPipeline;
        $this->touch();
    }

    public function isDefaultPipeline(): bool
    {
        return $this->defaultPipeline;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function activate(): void
    {
        $this->active = true;
        $this->touch();
    }

    public function deactivate(): void
    {
        $this->active = false;
        $this->defaultPipeline = false;
        $this->touch();
    }
}
