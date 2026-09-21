<?php

declare(strict_types=1);

namespace App\Relating\DataFixtures;

use App\Relating\Enum\RelationDemoScenarioKind;

final class RelationRelatingDemoSeed
{
    /**
     * @return list<RelationRelatingDemoScenario>
     */
    public function scenarios(): array
    {
        return [
            $this->relationshipStart(),
            $this->leadCapture(),
            $this->leadQualification(),
            $this->leadConversion(),
            $this->opportunityOpen(),
            $this->opportunityStageTransition(),
            $this->timelineProjection(),
            $this->aiReview(),
        ];
    }

    public function relationshipStart(): RelationRelatingDemoScenario
    {
        return new RelationRelatingDemoScenario(
            RelationDemoScenarioKind::RelationshipStart,
            'Relationship starts around an existing Vendor reference',
            'Start a CRM relationship lifecycle without recreating Vendor ownership.',
            ['start_relationship', 'assign_owner', 'mark_first_touch', 'project_timeline'],
            [
                'relationshipReference' => 'relationship_demo_001',
                'vendorReference' => 'vendor_demo_001',
                'ownerReference' => 'user_demo_owner',
            ],
        );
    }

    public function leadCapture(): RelationRelatingDemoScenario
    {
        return new RelationRelatingDemoScenario(
            RelationDemoScenarioKind::LeadCapture,
            'RelationLead captured from a business source',
            'Capture raw interest before creating or linking a Vendor relationship.',
            ['capture_lead', 'capture_source', 'schedule_follow_up', 'raise_signal'],
            [
                'leadReference' => 'lead_demo_001',
                'sourceReference' => 'source_demo_web_form',
                'email' => 'demo@example.test',
            ],
        );
    }

    public function leadQualification(): RelationRelatingDemoScenario
    {
        return new RelationRelatingDemoScenario(
            RelationDemoScenarioKind::LeadQualification,
            'RelationLead qualified through score and business intent',
            'Turn raw interest into qualified pipeline intent without generic update semantics.',
            ['enrich_lead', 'score_lead', 'qualify_lead', 'suggest_next_action'],
            [
                'leadReference' => 'lead_demo_001',
                'score' => 82,
                'temperature' => 'hot',
            ],
        );
    }

    public function leadConversion(): RelationRelatingDemoScenario
    {
        return new RelationRelatingDemoScenario(
            RelationDemoScenarioKind::LeadConversion,
            'RelationLead converted into Relationship plus RelationOpportunity',
            'Link the qualified lead to a Vendor reference and open the commercial opportunity.',
            ['link_vendor_reference', 'convert_lead', 'open_opportunity', 'project_timeline'],
            [
                'leadReference' => 'lead_demo_001',
                'relationshipReference' => 'relationship_demo_001',
                'opportunityReference' => 'opportunity_demo_001',
            ],
        );
    }

    public function opportunityOpen(): RelationRelatingDemoScenario
    {
        return new RelationRelatingDemoScenario(
            RelationDemoScenarioKind::OpportunityOpen,
            'RelationOpportunity opened in a pipeline',
            'Open commercial intent around Relationship while Product and Order stay neighbor-owned.',
            ['open_opportunity', 'attach_product_interest', 'forecast_pipeline', 'schedule_next_action'],
            [
                'opportunityReference' => 'opportunity_demo_001',
                'pipelineReference' => 'pipeline_demo_sales',
                'stageReference' => 'stage_demo_discovery',
                'productReference' => 'product_demo_001',
            ],
        );
    }

    public function opportunityStageTransition(): RelationRelatingDemoScenario
    {
        return new RelationRelatingDemoScenario(
            RelationDemoScenarioKind::OpportunityStageTransition,
            'RelationOpportunity moved through a business stage transition',
            'Record a pipeline transition, probability change, and forecast category as business events.',
            ['request_stage_transition', 'change_stage', 'recalculate_forecast', 'project_timeline'],
            [
                'opportunityReference' => 'opportunity_demo_001',
                'fromStageReference' => 'stage_demo_discovery',
                'toStageReference' => 'stage_demo_proposal',
                'probability' => 55,
            ],
        );
    }

    public function timelineProjection(): RelationRelatingDemoScenario
    {
        return new RelationRelatingDemoScenario(
            RelationDemoScenarioKind::TimelineProjection,
            'Timeline rebuilt from business signals',
            'Project a relationship history from Relating events and neighbor signals without owning neighbors.',
            ['ingest_neighbor_signal', 'normalize_signal', 'project_timeline_event', 'publish_timeline_view'],
            [
                'relationshipReference' => 'relationship_demo_001',
                'messageThreadReference' => 'message_thread_demo_001',
                'orderReference' => 'order_demo_001',
            ],
        );
    }

    public function aiReview(): RelationRelatingDemoScenario
    {
        return new RelationRelatingDemoScenario(
            RelationDemoScenarioKind::AiReview,
            'AI suggestion reviewed before application',
            'Keep AI advisory and audited: raised, reviewed, accepted or rejected, then applied only by business action.',
            ['raise_ai_suggestion', 'review_ai_suggestion', 'accept_ai_suggestion', 'apply_ai_suggestion', 'log_ai_decision'],
            [
                'suggestionReference' => 'ai_suggestion_demo_001',
                'targetReference' => 'opportunity_demo_001',
                'suggestionKind' => 'next_best_action',
            ],
        );
    }
}
