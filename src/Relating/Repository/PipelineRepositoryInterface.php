<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\Pipeline;
use App\Relating\Entity\PipelineStage;

interface PipelineRepositoryInterface
{
    public function rememberPublished(Pipeline $pipeline): void;

    public function rememberStagePublished(PipelineStage $stage): void;

    public function pipelineForCode(string $pipelineCode): ?Pipeline;

    /** @return list<PipelineStage> */
    public function stagesForPipeline(string $pipelineReference): array;
}
