<?php

declare(strict_types=1);

namespace App\Enum;

enum LeadConversionStatus: string
{
    case Pending = 'pending';
    case LinkedToVendor = 'linked_to_vendor';
    case OpportunityOpened = 'opportunity_opened';
    case Completed = 'completed';
    case Rejected = 'rejected';
}
