# Fixture scenario catalog

## relationship-start

Starts a `Relationship` around an existing `VendorReference`. The scenario proves that Relating can begin CRM lifecycle tracking without owning Vendor data.

Operations:

- `start_relationship`
- `assign_owner`
- `mark_first_touch`
- `project_timeline`

## lead-capture

Captures raw interest from a source before a relationship or Vendor link is confirmed.

Operations:

- `capture_lead`
- `capture_source`
- `schedule_follow_up`
- `raise_signal`

## lead-qualification

Scores and qualifies the lead using business intent.

Operations:

- `enrich_lead`
- `score_lead`
- `qualify_lead`
- `suggest_next_action`

## lead-conversion

Links the qualified lead to a relationship and opens commercial intent.

Operations:

- `link_vendor_reference`
- `convert_lead`
- `open_opportunity`
- `project_timeline`

## opportunity-open

Opens an `Opportunity` within a pipeline, while Product ownership stays in Producting/Production.

Operations:

- `open_opportunity`
- `attach_product_interest`
- `forecast_pipeline`
- `schedule_next_action`

## opportunity-stage-transition

Moves the opportunity through a business transition and records forecast semantics.

Operations:

- `request_stage_transition`
- `change_stage`
- `recalculate_forecast`
- `project_timeline`

## timeline-projection

Projects relationship history from Relating events and neighbor signals.

Operations:

- `ingest_neighbor_signal`
- `normalize_signal`
- `project_timeline_event`
- `publish_timeline_view`

## ai-review

Keeps AI advisory and auditable.

Operations:

- `raise_ai_suggestion`
- `review_ai_suggestion`
- `accept_ai_suggestion`
- `apply_ai_suggestion`
- `log_ai_decision`
