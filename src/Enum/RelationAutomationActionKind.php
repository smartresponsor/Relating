<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationAutomationActionKind: string
{
    case AssignOwner = 'assign_owner';
    case ScheduleTask = 'schedule_task';
    case RecordActivity = 'record_activity';
    case RequestTimelineRebuild = 'request_timeline_rebuild';
    case ScoreLead = 'score_lead';
    case TransitionOpportunity = 'transition_opportunity';
    case RecalculateForecast = 'recalculate_forecast';
    case RequestDuplicateReview = 'request_duplicate_review';
    case RaiseAiSuggestion = 'raise_ai_suggestion';
    case LinkMessageThread = 'link_message_thread';
    case RecalculateCaseSla = 'recalculate_case_sla';
    case RebuildCampaignPerformance = 'rebuild_campaign_performance';
}
