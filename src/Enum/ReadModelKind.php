<?php

declare(strict_types=1);

namespace App\Enum;

enum ReadModelKind: string
{
    case RelationshipTimeline = 'relationship_timeline';
    case OpportunityForecast = 'opportunity_forecast';
    case OpportunityRisk = 'opportunity_risk';
    case CampaignPerformance = 'campaign_performance';
    case CaseSla = 'case_sla';
    case RelationshipHealth = 'relationship_health';
    case NextBestAction = 'next_best_action';
}
