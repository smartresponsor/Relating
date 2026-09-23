<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationPipelineEntity;
use App\Relating\Entity\RelationPipelineStageEntity;

interface RelationPipelineRepositoryInterface
{
    public function rememberPublished(RelationPipelineEntity $pipeline): void;

    public function rememberStagePublished(RelationPipelineStageEntity $stage): void;

    public function pipelineForCode(string $pipelineCode): ?RelationPipelineEntity;

    /** @return list<RelationPipelineStageEntity> */
    public function stagesForPipeline(string $pipelineReference): array;
}
