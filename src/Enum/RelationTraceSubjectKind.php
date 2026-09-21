<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationTraceSubjectKind: string
{
    case Relationship = 'relationship';
    case Lead = 'lead';
    case Opportunity = 'opportunity';
    case Activity = 'activity';
    case Timeline = 'timeline';
    case Campaign = 'campaign';
    case CaseRecord = 'case_record';
    case AiSuggestion = 'ai_suggestion';
    case NeighborSignal = 'neighbor_signal';
}
