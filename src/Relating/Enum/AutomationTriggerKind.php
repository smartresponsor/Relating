<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum AutomationTriggerKind: string
{
    case LeadCaptured = 'lead_captured';
    case LeadQualified = 'lead_qualified';
    case LeadConverted = 'lead_converted';
    case OpportunityStageChanged = 'opportunity_stage_changed';
    case ActivityCompleted = 'activity_completed';
    case TaskOverdue = 'task_overdue';
    case CampaignResponseCaptured = 'campaign_response_captured';
    case CaseEscalated = 'case_escalated';
    case RelationshipSignalRecorded = 'relationship_signal_recorded';
    case AiSuggestionAccepted = 'ai_suggestion_accepted';
}
