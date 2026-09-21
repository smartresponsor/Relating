<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\ValueObject\Trace\RelationTransitionTrace;

interface RelationTransitionTraceRecorderInterface
{
    public function record(RelationTransitionTrace $trace): void;
}
