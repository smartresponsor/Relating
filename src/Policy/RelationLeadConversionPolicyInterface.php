<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Command\RelationConvertLeadCommand;

interface RelationLeadConversionPolicyInterface
{
    public function decideLeadConversion(RelationConvertLeadCommand $command): RelationPolicyDecisionResult;
}
