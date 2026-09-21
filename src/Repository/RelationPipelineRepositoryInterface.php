<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationPipeline;
use App\Relating\Entity\RelationPipelineStage;

interface RelationPipelineRepositoryInterface
{
    public function rememberPublished(RelationPipeline $pipeline): void;

    public function rememberStagePublished(RelationPipelineStage $stage): void;

    public function pipelineForCode(string $pipelineCode): ?RelationPipeline;

    /** @return list<RelationPipelineStage> */
    public function stagesForPipeline(string $pipelineReference): array;
}
