# Relating Business Chain Catalog

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

Relating owns business lifecycle chains, not CRUD lifecycle routes.

## Chain 1: relationship onboarding

```text
vendor_reference_selected
relationship_opened
relationship_participant_added
source_attached
first_touch_recorded
next_action_planned
relationship_profile_available
```

Primary objects:

```text
Relationship
RelationshipParticipant
Source
TimelineRecord
Task
RelationshipSummaryView
RelationshipTimelineView
```

## Chain 2: lead capture and conversion

```text
lead_captured
lead_enriched
duplicate_candidate_detected
lead_qualified
vendor_reference_created_or_linked
relationship_opened_or_reused
opportunity_opened
lead_converted
```

Primary objects:

```text
Lead
LeadSource
LeadQualification
LeadScore
DuplicateCandidate
MergeProposal
LeadConversion
Relationship
Opportunity
```

## Chain 3: opportunity pipeline

```text
opportunity_opened
stage_changed
discovery_completed
proposal_requested
proposal_sent
negotiation_started
commit_marked
closed_won_or_lost
post_close_signal_created
```

Primary objects:

```text
Opportunity
Pipeline
PipelineStage
OpportunityStageHistory
OpportunityProductInterest
OpportunityForecast
OpportunityLossReason
QuoteIntent
CommercialTerm
```

## Chain 4: activity and timeline

```text
activity_planned
activity_completed
timeline_event_recorded
message_thread_linked
next_task_created
relationship_health_updated
```

Primary objects:

```text
Activity
ActivityTarget
ActivityParticipant
Task
Note
Call
Meeting
Reminder
TimelineRecord
```

## Chain 5: campaign and attribution

```text
target_list_created
campaign_member_added
campaign_touch_sent
response_captured
first_touch_or_last_touch_updated
lead_or_relationship_signal_created
```

Primary objects:

```text
Campaign
TargetList
TargetListMember
CampaignMember
CampaignTouch
CampaignResponse
UtmAttribution
RelationshipSignal
```

## Chain 6: case and escalation

```text
case_opened
case_thread_linked
case_sla_started
case_escalated
case_resolved
relationship_timeline_updated
```

Primary objects:

```text
CaseRecord
CaseThread
CaseSla
CaseEscalation
CaseResolution
TimelineRecord
RelationshipSignal
```

## Chain 7: AI review loop

```text
signal_collected
ai_scoring_run_created
ai_suggestion_created
human_or_policy_reviewed
suggestion_accepted_or_rejected
decision_logged
business_action_dispatched
```

Primary objects:

```text
RelationshipSignal
AiScoringRun
AiSuggestion
AiDecisionLog
AutomationRule
AutomationRun
```

## Business route candidates only

These route names are allowed because they express business actions rather than CRUD actions:

```text
/relating/catalog
/relating/relationship/profile
/relating/relationship/timeline
/relating/relationship/graph
/relating/lead/qualify
/relating/lead/convert
/relating/opportunity/transition
/relating/opportunity/forecast
/relating/activity/complete
/relating/campaign/response/capture
/relating/case/escalate
/relating/ai/review
```

Forbidden route/action vocabulary remains:

```text
index
create
read
update
delete
```
