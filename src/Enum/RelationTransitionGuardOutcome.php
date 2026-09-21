<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationTransitionGuardOutcome: string
{
    case Pass = 'pass';
    case Block = 'block';
    case Review = 'review';
}
