<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\Trace\TraceCorrelationId;

interface TraceCorrelationIdFactoryInterface
{
    public function nextCorrelationId(string $businessPrefix): TraceCorrelationId;
}
