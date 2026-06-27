<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Trace\NeighborSignalTrace;

interface NeighborSignalTraceRecorderInterface
{
    public function record(NeighborSignalTrace $trace): void;
}
