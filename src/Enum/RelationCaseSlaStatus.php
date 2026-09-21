<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationCaseSlaStatus: string
{
    case NotStarted = 'not_started';
    case Running = 'running';
    case Breached = 'breached';
    case Paused = 'paused';
    case Satisfied = 'satisfied';
}
