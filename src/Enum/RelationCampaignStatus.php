<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationCampaignStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case Paused = 'paused';
    case Completed = 'completed';
    case Archived = 'archived';
}
