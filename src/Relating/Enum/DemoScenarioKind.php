<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum DemoScenarioKind: string
{
    case RelationshipStart = 'relationship_start';
    case LeadCapture = 'lead_capture';
    case LeadQualification = 'lead_qualification';
    case LeadConversion = 'lead_conversion';
    case OpportunityOpen = 'opportunity_open';
    case OpportunityStageTransition = 'opportunity_stage_transition';
    case TimelineProjection = 'timeline_projection';
    case AiReview = 'ai_review';

    /**
     * @return list<string>
     */
    public static function codes(): array
    {
        return array_map(
            static fn (self $kind): string => $kind->value,
            self::cases(),
        );
    }
}
