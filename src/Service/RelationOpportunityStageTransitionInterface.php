<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationOpportunity;
use App\Relating\Entity\RelationOpportunityStageHistory;

interface RelationOpportunityStageTransitionInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function transitionOpportunityToStage(RelationOpportunity $opportunity, string $stageReference, int $probability, array $context = []): RelationOpportunityStageHistory;
}
