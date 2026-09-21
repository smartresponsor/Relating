<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationTraceRetentionClass: string
{
    case Operational = 'operational';
    case Compliance = 'compliance';
    case AiDecision = 'ai_decision';
    case SecurityAdjacent = 'security_adjacent';
    case Diagnostic = 'diagnostic';
}
