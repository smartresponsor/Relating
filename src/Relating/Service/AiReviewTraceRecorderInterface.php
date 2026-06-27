<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Trace\AiReviewTrace;

interface AiReviewTraceRecorderInterface
{
    public function record(AiReviewTrace $trace): void;
}
