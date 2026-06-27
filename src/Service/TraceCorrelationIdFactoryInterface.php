<?php

declare(strict_types=1);

namespace App\Service;

use App\Trace\TraceCorrelationId;

interface TraceCorrelationIdFactoryInterface
{
    public function nextCorrelationId(string $businessPrefix): TraceCorrelationId;
}
