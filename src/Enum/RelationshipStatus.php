<?php

declare(strict_types=1);

namespace App\Enum;

enum RelationshipStatus: string
{
    case Active = 'active';
    case Dormant = 'dormant';
    case Blocked = 'blocked';
    case Archived = 'archived';
}
