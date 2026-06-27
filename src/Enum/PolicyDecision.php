<?php

declare(strict_types=1);

namespace App\Enum;

enum PolicyDecision: string
{
    case Allowed = 'allowed';
    case Denied = 'denied';
    case NeedsReview = 'needs_review';
}
