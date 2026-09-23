<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationOpportunityEntity;
use App\Relating\Entity\RelationOpportunityStageHistoryEntity;

interface RelationOpportunityStageTransitionInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function transitionOpportunityToStage(RelationOpportunityEntity $opportunity, string $stageReference, int $probability, array $context = []): RelationOpportunityStageHistoryEntity;
}
