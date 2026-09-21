<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationActivityDirection: string
{
    case Inbound = 'inbound';
    case Outbound = 'outbound';
    case Internal = 'internal';
}
