<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Trace\TraceCorrelationId;

interface TraceCorrelationIdFactoryInterface
{
    public function nextCorrelationId(string $businessPrefix): TraceCorrelationId;
}
