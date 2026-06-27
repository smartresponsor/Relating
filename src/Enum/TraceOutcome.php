<?php

declare(strict_types=1);

namespace App\Enum;

enum TraceOutcome: string
{
    case Allowed = 'allowed';
case Rejected = 'rejected';
case NeedsReview = 'needs_review';
case Applied = 'applied';
case Skipped = 'skipped';
case Failed = 'failed';
}
