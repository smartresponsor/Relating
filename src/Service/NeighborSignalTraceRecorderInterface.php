<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\Trace\NeighborSignalTrace;

interface NeighborSignalTraceRecorderInterface
{
    public function record(NeighborSignalTrace $trace): void;
}
