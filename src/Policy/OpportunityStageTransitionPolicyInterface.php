<?php

declare(strict_types=1);

namespace App\Policy;

use App\Command\TransitionOpportunityStageCommand;

interface OpportunityStageTransitionPolicyInterface
{
    public function guardOpportunityStageTransition(TransitionOpportunityStageCommand $command): TransitionGuardResult;
}
