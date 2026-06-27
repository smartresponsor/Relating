<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Opportunity;
use App\Entity\OpportunityStageHistory;

interface OpportunityStageTransitionInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function transitionOpportunityToStage(Opportunity $opportunity, string $stageReference, int $probability, array $context = []): OpportunityStageHistory;
}
