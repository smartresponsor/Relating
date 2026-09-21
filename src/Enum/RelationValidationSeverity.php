<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationValidationSeverity: string
{
    case Info = 'info';
    case Warning = 'warning';
    case Error = 'error';
    case Blocking = 'blocking';
}
