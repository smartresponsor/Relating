<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationForecastCategory: string
{
    case Pipeline = 'pipeline';
    case BestCase = 'best_case';
    case Commit = 'commit';
    case Closed = 'closed';
    case Omitted = 'omitted';
}
