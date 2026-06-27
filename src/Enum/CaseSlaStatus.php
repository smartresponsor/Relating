<?php

declare(strict_types=1);

namespace App\Enum;

enum CaseSlaStatus: string
{
    case NotStarted = 'not_started';
    case Running = 'running';
    case Breached = 'breached';
    case Paused = 'paused';
    case Satisfied = 'satisfied';
}
