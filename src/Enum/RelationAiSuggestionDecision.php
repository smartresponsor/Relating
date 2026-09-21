<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationAiSuggestionDecision: string
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case Applied = 'applied';
    case Expired = 'expired';
    case RolledBack = 'rolled_back';
}
