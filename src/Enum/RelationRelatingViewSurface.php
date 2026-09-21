<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationRelatingViewSurface: string
{
    case RelationshipSummary = 'relationship.summary';
    case RelationshipProfile = 'relationship.profile';
    case RelationshipTimeline = 'relationship.timeline';
    case RelationshipGraph = 'relationship.graph';
    case LeadList = 'lead.list';
    case LeadDetail = 'lead.detail';
    case LeadKanban = 'lead.kanban';
    case LeadConversion = 'lead.conversion';
    case OpportunityList = 'opportunity.list';
    case OpportunityDetail = 'opportunity.detail';
    case OpportunityBoard = 'opportunity.board';
    case OpportunityForecast = 'opportunity.forecast';
    case ActivityTimeline = 'activity.timeline';
    case TaskBoard = 'task.board';
    case CampaignPerformance = 'campaign.performance';
    case CampaignResponse = 'campaign.response';
    case CaseQueue = 'case.queue';
    case CaseDetail = 'case.detail';
    case AiSuggestionReview = 'ai.suggestion_review';
    case NextBestAction = 'ai.next_best_action';
    case AutomationRun = 'automation.run';
    case MetadataSchema = 'metadata.schema';
    case DemoScenario = 'demo.scenario';
    case Dashboard = 'dashboard';
}
