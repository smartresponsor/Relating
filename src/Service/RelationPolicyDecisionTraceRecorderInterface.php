<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\ValueObject\Trace\RelationPolicyDecisionTrace;

interface RelationPolicyDecisionTraceRecorderInterface
{
    public function record(RelationPolicyDecisionTrace $trace): void;
}
