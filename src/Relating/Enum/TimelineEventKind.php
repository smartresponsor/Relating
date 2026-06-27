<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum TimelineEventKind: string
{
    case RelationshipStarted = 'relationship_started';
    case LeadQualified = 'lead_qualified';
    case OpportunityOpened = 'opportunity_opened';
    case OpportunityStageChanged = 'opportunity_stage_changed';
    case ActivityPlanned = 'activity_planned';
    case ActivityCompleted = 'activity_completed';
    case CampaignResponseCaptured = 'campaign_response_captured';
    case CaseOpened = 'case_opened';
    case AiSuggestionRaised = 'ai_suggestion_raised';
    case NeighborSignalCaptured = 'neighbor_signal_captured';
}
