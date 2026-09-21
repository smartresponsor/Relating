<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Command\RelationTransitionOpportunityStageCommand;

interface RelationOpportunityStageTransitionPolicyInterface
{
    public function guardOpportunityStageTransition(RelationTransitionOpportunityStageCommand $command): RelationTransitionGuardResult;
}
