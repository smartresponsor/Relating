<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\ValueObject\Trace\RelationNeighborSignalTrace;

interface RelationNeighborSignalTraceRecorderInterface
{
    public function record(RelationNeighborSignalTrace $trace): void;
}
