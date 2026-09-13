<?php

declare(strict_types=1);

namespace App\Policy;

use App\Command\StartRelationshipCommand;

interface RelationshipStartPolicyInterface
{
    public function decideRelationshipStart(StartRelationshipCommand $command): PolicyDecisionResult;
}
