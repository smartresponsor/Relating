<?php

declare(strict_types=1);

namespace App\Enum;

enum RelationshipLifecycleStage: string
{
    case New = 'new';
    case Nurturing = 'nurturing';
    case Active = 'active';
    case Retaining = 'retaining';
    case AtRisk = 'at_risk';
    case Dormant = 'dormant';
    case Closed = 'closed';
}
