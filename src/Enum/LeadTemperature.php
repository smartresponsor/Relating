<?php

declare(strict_types=1);


namespace App\Enum;

enum LeadTemperature: string
{
    case Cold = 'cold';
    case Warm = 'warm';
    case Hot = 'hot';
}
