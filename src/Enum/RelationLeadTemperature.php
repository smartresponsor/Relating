<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationLeadTemperature: string
{
    case Cold = 'cold';
    case Warm = 'warm';
    case Hot = 'hot';
}
