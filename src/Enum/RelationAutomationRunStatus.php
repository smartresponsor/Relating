<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationAutomationRunStatus: string
{
    case Pending = 'pending';
    case Running = 'running';
    case Succeeded = 'succeeded';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
}
