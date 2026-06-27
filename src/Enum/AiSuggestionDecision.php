<?php

declare(strict_types=1);

namespace App\Enum;

enum AiSuggestionDecision: string
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case Applied = 'applied';
    case Expired = 'expired';
    case RolledBack = 'rolled_back';
}
