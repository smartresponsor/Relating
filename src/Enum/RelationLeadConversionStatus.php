<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationLeadConversionStatus: string
{
    case Pending = 'pending';
    case LinkedToVendor = 'linked_to_vendor';
    case OpportunityOpened = 'opportunity_opened';
    case Completed = 'completed';
    case Rejected = 'rejected';
}
