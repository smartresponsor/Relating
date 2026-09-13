<?php

declare(strict_types=1);

namespace App\Enum;

enum TraceActorKind: string
{
    case Human = 'human';
    case Automation = 'automation';
    case AiAgent = 'ai_agent';
    case System = 'system';
    case NeighborComponent = 'neighbor_component';
}
