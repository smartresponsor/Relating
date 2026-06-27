<?php

declare(strict_types=1);

namespace App\Policy;

use App\Application\Command\QualifyLeadCommand;

interface LeadQualificationPolicyInterface
{
    public function decideLeadQualification(QualifyLeadCommand $command): PolicyDecisionResult;
}
