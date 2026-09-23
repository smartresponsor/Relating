<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use App\Relating\Enum\RelationForecastCategory;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_pipeline_stage')]
#[ORM\Index(columns: ['tenant_reference', 'pipeline_reference'], name: 'idx_relating_stage_tenant_pipeline')]
#[ORM\Index(columns: ['pipeline_reference', 'position'], name: 'idx_relating_stage_position')]
final class RelationPipelineStageEntity extends RelationAbstractNamedRelatingEntity
{
    #[ORM\Column(type: 'string', length: 128)]
    private string $pipelineReference;

    #[ORM\Column(type: 'integer')]
    private int $position;

    #[ORM\Column(type: 'integer')]
    private int $probability = 0;

    #[ORM\Column(type: 'string', length: 64)]
    private string $forecastCategory;

    #[ORM\Column(type: 'boolean')]
    private bool $terminal = false;

    public function __construct(string $id, string $pipelineReference, string $code, ?string $name, int $position, int $probability = 0, RelationForecastCategory $forecastCategory = RelationForecastCategory::Pipeline, array $data = [])
    {
        parent::__construct($id, $code, $name, $data);
        $this->pipelineReference = $this->requiredText($pipelineReference, 'RelationPipeline reference', 128);
        $this->position = $this->nonNegativeInt($position, 'Stage position');
        $this->probability = $this->scoreValue($probability, 'Stage probability');
        $this->forecastCategory = $forecastCategory->value;
    }

    public function pipelineReference(): string
    {
        return $this->pipelineReference;
    }

    public function position(): int
    {
        return $this->position;
    }

    public function probability(): int
    {
        return $this->probability;
    }

    public function reposition(int $position): void
    {
        $this->position = $this->nonNegativeInt($position, 'Stage position');
        $this->touch();
    }

    public function tuneForecast(int $probability, RelationForecastCategory $forecastCategory): void
    {
        $this->probability = $this->scoreValue($probability, 'Stage probability');
        $this->forecastCategory = $forecastCategory->value;
        $this->touch();
    }

    public function markTerminal(bool $terminal = true): void
    {
        $this->terminal = $terminal;
        $this->touch();
    }
}
