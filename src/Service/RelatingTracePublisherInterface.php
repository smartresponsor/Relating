<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\Trace\BusinessDecisionTrace;

interface RelatingTracePublisherInterface
{
    public function publishBusinessDecisionTrace(BusinessDecisionTrace $trace): void;
}
