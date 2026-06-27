<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum NeighborSignalDirection: string
{
    case Incoming = 'incoming';
    case Outgoing = 'outgoing';
    case Projected = 'projected';
}
