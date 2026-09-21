<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Command\RelationStartRelationshipCommand;

interface RelationshipStartPolicyInterface
{
    public function decideRelationshipStart(RelationStartRelationshipCommand $command): RelationPolicyDecisionResult;
}
