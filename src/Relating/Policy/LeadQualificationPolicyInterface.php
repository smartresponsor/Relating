<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Application\Command\QualifyLeadCommand;

interface LeadQualificationPolicyInterface
{
    public function decideLeadQualification(QualifyLeadCommand $command): PolicyDecisionResult;
}
