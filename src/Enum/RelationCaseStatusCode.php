<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationCaseStatusCode: string
{
    case Open = 'open';
    case Pending = 'pending';
    case Escalated = 'escalated';
    case Resolved = 'resolved';
    case Closed = 'closed';
}
