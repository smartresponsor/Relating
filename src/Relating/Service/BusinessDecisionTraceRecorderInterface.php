<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Trace\BusinessDecisionTrace;

interface BusinessDecisionTraceRecorderInterface
{
    public function record(BusinessDecisionTrace $trace): void;
}
