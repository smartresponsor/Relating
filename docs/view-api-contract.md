# Relating View API Contract

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

Relating must not expose Doctrine entities as API contracts.

Every UI/API surface uses explicit ViewObjects. This keeps CRM business views stable even when EntityFirst internals evolve.

## Rules

```text
Entity is persistence model.
ViewObject is API/UI contract.
Route is business action.
CRUD is outside Relating.
```

## Core ViewObjects

| ViewObject | Purpose | Source inspiration | CRUD risk |
|---|---|---|---|
| RelationshipProfileView | Customer/relationship 360 | OroCRM customer 360, SuiteCRM accounts/contacts | Safe if read-model only |
| RelationshipGraphView | Vendor-to-vendor/person/org relationship graph | CiviCRM relationships, Oro account/contact hierarchy | Safe if graph projection only |
| RelationshipTimelineView | Unified interaction history | SuiteCRM activities, CiviCRM activities | Safe if projection only |
| LeadListView | Lead work queue | SuiteCRM/Espo/Krayin leads | Safe if not generic list CRUD route |
| LeadQualificationView | Qualification decision surface | Oro lead qualification | Business action surface |
| LeadConversionView | Lead to relationship/vendor/opportunity conversion | Espo/Suite conversion | Business action surface |
| OpportunityBoardView | Kanban board | Twenty Kanban, Oro opportunity workflow | Safe if transition is business action |
| OpportunityDetailView | Deal context | Suite/Espo opportunities | Safe if not generic entity read route |
| OpportunityForecastView | Forecast and probability | Espo/Oro forecasting | Safe read model |
| OpportunityRiskView | Risk analysis and next action | AI-native extension | Business insight surface |
| ActivityTimelineView | Activities as relationship memory | Suite/Espo/CiviCRM activities | Safe read model |
| TaskBoardView | Next-action board | Twenty/Suite tasks | Safe if completion is business action |
| CampaignPerformanceView | Campaign response and attribution | Suite/Oro campaigns | Safe read model |
| TargetListView | Audience/target list | Suite target lists, Civi groups | Safe if membership operations named |
| CaseQueueView | Case triage queue | Suite cases, CiviCase | Safe if triage/escalate/resolve actions |
| CaseDetailView | Issue/resolution record | Suite cases | Safe if not CRUD read route |
| CaseSlaView | SLA state and escalation pressure | Support CRM practice | Business state surface |
| QuoteIntentView | Commercial intent before order | Suite/Krayin quotes | Safe if final order owned elsewhere |
| DuplicateCandidateView | Duplicate review | Espo/Suite duplicate/conversion practice | Business review surface |
| AiSuggestionReviewView | Human review of AI output | Twenty agents + governance | Business review surface |
| AiDecisionLogView | Audit of AI suggestion lifecycle | SmartResponsor addition | Safe audit view |
| NextBestActionView | Recommended action | AI-native extension | Safe if suggestion-only |
| RelatingDashboardView | CRM command center | Suite/Oro dashboards | Safe read model |
| RelatingObjectSchemaView | Metadata schema display | Twenty/Espo/Krayin metadata | Safe catalog view |
| RelatingLayoutSchemaView | Layout registry display | Twenty/Espo layouts/views | Safe catalog view |

## Business read route pattern

Allowed:

```text
GET /relating/catalog
GET /relating/dashboard/{dashboardId}/business-view
POST /relating/relationship/{relationshipId}/timeline/build
POST /relating/opportunity/{opportunityId}/forecast/recalculate
```

Forbidden:

```text
GET /relating/relationship/{id}
GET /relating/lead
POST /relating/lead
PATCH /relating/opportunity/{id}
DELETE /relating/activity/{id}
```

## ViewObject build policy

A ViewObject can be built from:

```text
Relating entities
Neighbor references
Projection tables
Messenger-updated read models
Search index results
AI suggestion records
```

A ViewObject must not:

```text
Perform mutation
Act as Doctrine entity
Hide generic CRUD operation
Call external APIs directly
Bypass Accessing
```
