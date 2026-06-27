<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Trace\BusinessDecisionTrace;

interface RelatingTracePublisherInterface
{
    public function publishBusinessDecisionTrace(BusinessDecisionTrace $trace): void;
}
