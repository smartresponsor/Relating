<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationAutomationConditionOperator: string
{
    case Equals = 'equals';
    case NotEquals = 'not_equals';
    case In = 'in';
    case NotIn = 'not_in';
    case GreaterThan = 'greater_than';
    case GreaterOrEqual = 'greater_or_equal';
    case LessThan = 'less_than';
    case LessOrEqual = 'less_or_equal';
    case Contains = 'contains';
    case Exists = 'exists';
    case Missing = 'missing';
    case ChangedTo = 'changed_to';
    case OlderThan = 'older_than';
    case WithinNext = 'within_next';
}
