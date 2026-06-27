<?php

declare(strict_types=1);

namespace App\Service;

use App\Trace\TransitionTrace;

interface TransitionTraceRecorderInterface
{
    public function record(TransitionTrace $trace): void;
}
