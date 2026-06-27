<?php

declare(strict_types=1);


namespace App\Enum;

enum OpportunityStatus: string
{
    case Open = 'open';
    case Won = 'won';
    case Lost = 'lost';
    case Paused = 'paused';
    case Archived = 'archived';
}
