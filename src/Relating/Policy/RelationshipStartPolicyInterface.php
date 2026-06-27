<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Application\Command\StartRelationshipCommand;

interface RelationshipStartPolicyInterface
{
    public function decideRelationshipStart(StartRelationshipCommand $command): PolicyDecisionResult;
}
