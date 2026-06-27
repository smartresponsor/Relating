<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\Opportunity;
use App\Relating\Entity\OpportunityStageHistory;

interface OpportunityStageTransitionInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function transitionOpportunityToStage(Opportunity $opportunity, string $stageReference, int $probability, array $context = []): OpportunityStageHistory;
}
