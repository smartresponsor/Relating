<?php

declare(strict_types=1);


namespace App\Relating\Enum;

enum ProjectionFreshness: string
{
    case Live = 'live';
    case Warm = 'warm';
    case Stale = 'stale';
}
