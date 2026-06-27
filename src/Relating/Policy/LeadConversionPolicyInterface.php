<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Application\Command\ConvertLeadCommand;

interface LeadConversionPolicyInterface
{
    public function decideLeadConversion(ConvertLeadCommand $command): PolicyDecisionResult;
}
