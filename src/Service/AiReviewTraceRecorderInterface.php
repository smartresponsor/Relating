<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\Trace\AiReviewTrace;

interface AiReviewTraceRecorderInterface
{
    public function record(AiReviewTrace $trace): void;
}
