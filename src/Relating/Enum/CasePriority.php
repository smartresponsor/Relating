<?php

declare(strict_types=1);


namespace App\Relating\Enum;

enum CasePriority: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';
    case Urgent = 'urgent';
}
