<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Trace\PolicyDecisionTrace;

interface PolicyDecisionTraceRecorderInterface
{
    public function record(PolicyDecisionTrace $trace): void;
}
