# Automation Trigger / Condition / Action Catalog

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

## Trigger kinds

```text
lead_captured
lead_qualified
lead_converted
opportunity_stage_changed
activity_completed
task_overdue
campaign_response_captured
case_escalated
relationship_signal_recorded
ai_suggestion_accepted
```

## Condition operators

```text
equals
not_equals
in
not_in
greater_than
greater_or_equal
less_than
less_or_equal
contains
exists
missing
changed_to
older_than
within_next
```

## Action kinds

```text
assign_owner
schedule_task
record_activity
request_timeline_rebuild
score_lead
transition_opportunity
recalculate_forecast
request_duplicate_review
raise_ai_suggestion
link_message_thread
recalculate_case_sla
rebuild_campaign_performance
```

## Allowed automation examples

```text
When LeadCaptured and source is web_form -> ScoreLeadMessage.
When LeadQualified and no vendor reference -> DetectLeadDuplicateMessage.
When LeadConverted -> Open opportunity through business service.
When OpportunityStageChanged to proposal -> Schedule follow-up task.
When CampaignResponseCaptured positive -> Raise next-best-action AI suggestion.
When CaseEscalated -> Recalculate SLA and notify owner reference.
```

## Forbidden automation examples

```text
When EntityCreated -> run generic workflow.
When EntityUpdated -> mutate arbitrary fields.
When /relating/lead/create is called -> dispatch workflow.
When Doctrine postPersist fires -> infer CRM lifecycle.
```

Lifecycle must be explicit and business-named.
