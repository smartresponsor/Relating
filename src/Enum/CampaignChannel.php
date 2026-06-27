<?php

declare(strict_types=1);

namespace App\Enum;

enum CampaignChannel: string
{
    case Email = 'email';
    case Message = 'message';
    case Phone = 'phone';
    case Social = 'social';
    case Event = 'event';
    case Referral = 'referral';
    case Manual = 'manual';
}
