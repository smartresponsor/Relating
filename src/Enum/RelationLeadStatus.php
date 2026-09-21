<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationLeadStatus: string
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
