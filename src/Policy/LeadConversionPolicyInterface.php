<?php

declare(strict_types=1);

namespace App\Policy;

use App\Command\ConvertLeadCommand;

interface LeadConversionPolicyInterface
{
    public function decideLeadConversion(ConvertLeadCommand $command): PolicyDecisionResult;
}
