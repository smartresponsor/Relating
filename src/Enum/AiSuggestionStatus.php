<?php

declare(strict_types=1);


namespace App\Enum;

enum AiSuggestionStatus: string
{
    case Suggested = 'suggested';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case Applied = 'applied';
    case RolledBack = 'rolled_back';
}
