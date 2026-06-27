<?php

declare(strict_types=1);

namespace App\Enum;

enum TransitionGuardOutcome: string
{
    case Pass = 'pass';
    case Block = 'block';
    case Review = 'review';
}
