<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationViewType: string
{
    case Table = 'table';
    case Detail = 'detail';
    case Kanban = 'kanban';
    case Calendar = 'calendar';
    case Timeline = 'timeline';
    case Dashboard = 'dashboard';
    case Compact = 'compact';
    case Search = 'search';
    case BulkReview = 'bulk_review';
    case ImportMapping = 'import_mapping';
    case DuplicateReview = 'duplicate_review';
    case AiReview = 'ai_review';
}
