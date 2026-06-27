<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum ActivityDirection: string
{
    case Inbound = 'inbound';
    case Outbound = 'outbound';
    case Internal = 'internal';
}
