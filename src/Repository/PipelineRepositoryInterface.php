<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Pipeline;
use App\Entity\PipelineStage;

interface PipelineRepositoryInterface
{
    public function rememberPublished(Pipeline $pipeline): void;

    public function rememberStagePublished(PipelineStage $stage): void;

    public function pipelineForCode(string $pipelineCode): ?Pipeline;

    /** @return list<PipelineStage> */
    public function stagesForPipeline(string $pipelineReference): array;
}
