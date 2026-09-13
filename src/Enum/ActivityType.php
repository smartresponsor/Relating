<?php

declare(strict_types=1);

namespace App\Enum;

enum ActivityType: string
{
    case Task = 'task';
    case Note = 'note';
    case Call = 'call';
    case Meeting = 'meeting';
    case Email = 'email';
    case Message = 'message';
    case System = 'system';
}
