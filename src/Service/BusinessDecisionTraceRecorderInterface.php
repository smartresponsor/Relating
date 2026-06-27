<?php

declare(strict_types=1);

namespace App\Service;

use App\Trace\BusinessDecisionTrace;

interface BusinessDecisionTraceRecorderInterface
{
    public function record(BusinessDecisionTrace $trace): void;
}
