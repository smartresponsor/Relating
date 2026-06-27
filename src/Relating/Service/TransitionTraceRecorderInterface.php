<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Trace\TransitionTrace;

interface TransitionTraceRecorderInterface
{
    public function record(TransitionTrace $trace): void;
}
