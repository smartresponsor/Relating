<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationAutomationSafetyLevel: string
{
    case SafeRead = 'safe_read';
    case BusinessWrite = 'business_write';
    case NeighborSignal = 'neighbor_signal';
    case AiSuggested = 'ai_suggested';
    case RequiresReview = 'requires_review';
    case Blocked = 'blocked';
}
