<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationCasePriority: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';
    case Urgent = 'urgent';
}
