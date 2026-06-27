<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Application\Command\TransitionOpportunityStageCommand;

interface OpportunityStageTransitionPolicyInterface
{
    public function guardOpportunityStageTransition(TransitionOpportunityStageCommand $command): TransitionGuardResult;
}
