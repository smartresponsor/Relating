<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Command\RelationQualifyLeadCommand;

interface RelationLeadQualificationPolicyInterface
{
    public function decideLeadQualification(RelationQualifyLeadCommand $command): RelationPolicyDecisionResult;
}
