<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationTraceDecisionKind: string
{
    case RelationshipStart = 'relationship_start';
    case LeadQualification = 'lead_qualification';
    case LeadConversion = 'lead_conversion';
    case OpportunityStageTransition = 'opportunity_stage_transition';
    case AiSuggestionReview = 'ai_suggestion_review';
    case NeighborSignalAcceptance = 'neighbor_signal_acceptance';
    case PolicyDecision = 'policy_decision';
}
