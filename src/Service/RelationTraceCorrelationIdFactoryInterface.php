<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\ValueObject\Trace\RelationTraceCorrelationId;

interface RelationTraceCorrelationIdFactoryInterface
{
    public function nextCorrelationId(string $businessPrefix): RelationTraceCorrelationId;
}
