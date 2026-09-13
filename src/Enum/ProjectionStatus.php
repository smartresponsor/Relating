<?php

declare(strict_types=1);

namespace App\Enum;

enum ProjectionStatus: string
{
    case Pending = 'pending';
    case Projected = 'projected';
    case Stale = 'stale';
    case Failed = 'failed';
}
