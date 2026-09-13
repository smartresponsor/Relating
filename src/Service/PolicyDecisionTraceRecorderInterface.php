<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\Trace\PolicyDecisionTrace;

interface PolicyDecisionTraceRecorderInterface
{
    public function record(PolicyDecisionTrace $trace): void;
}
