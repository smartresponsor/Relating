<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationProjectionStatus: string
{
    case Pending = 'pending';
    case Projected = 'projected';
    case Stale = 'stale';
    case Failed = 'failed';
}
