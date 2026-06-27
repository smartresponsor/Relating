<?php

declare(strict_types=1);


namespace App\Enum;

enum LeadStatus: string
{
    case New = 'new';
    case Captured = 'captured';
    case Enriched = 'enriched';
    case Qualified = 'qualified';
    case Disqualified = 'disqualified';
    case Converted = 'converted';
    case Duplicate = 'duplicate';
    case Archived = 'archived';
}
