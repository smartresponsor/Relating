<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\ValueObject\Trace\RelationAiReviewTrace;

interface RelationAiReviewTraceRecorderInterface
{
    public function record(RelationAiReviewTrace $trace): void;
}
