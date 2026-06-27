# Relating Automation Workflow Matrix

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This document converts open-source CRM workflow ideas into the SmartResponsor `Relating` canon.

Relating automation is business-lifecycle automation. It is not CRUD automation.

## Boundary

```text
Allowed:   lead qualification, lead conversion, opportunity transition, timeline rebuild, SLA recalculation, duplicate review, AI suggestion review.
Forbidden: create/read/update/delete/index routes, generic entity lifecycle hooks, generic CRUD workflow events.
```

## Trigger groups

| Group | Trigger | Canonical event | Primary target |
|---|---|---|---|
| Relationship | relationship starts | `RelationshipStarted` | `Relationship` |
| Relationship | vendor linked | `RelationshipLinkedToVendor` | `Relationship` + `VendorReference` |
| Relationship | signal recorded | `RelationshipSignalRecorded` | `RelationshipSignal` |
| Lead | lead captured | `LeadCaptured` | `Lead` |
| Lead | lead score changed | `LeadScoreCalculated` | `LeadScore` |
| Lead | qualified | `LeadQualified` | `LeadQualification` |
| Lead | rejected | `LeadRejected` | `LeadRejection` |
| Lead | duplicate suspected | `LeadDuplicateCandidateDetected` | `DuplicateCandidate` |
| Lead | converted | `LeadConverted` | `LeadConversion` |
| Opportunity | opened | `OpportunityOpened` | `Opportunity` |
| Opportunity | transition requested | `OpportunityStageTransitionRequested` | `Opportunity` |
| Opportunity | stage changed | `OpportunityStageChanged` | `OpportunityStageHistory` |
| Opportunity | risk changed | `OpportunityRiskScoreChanged` | `Opportunity` |
| Activity | completed | `ActivityCompleted` | `Activity` |
| Activity | task overdue | `TaskOverdue` | `Task` |
| Campaign | response captured | `CampaignResponseCaptured` | `CampaignResponse` |
| Case | escalated | `CaseEscalated` | `CaseRecord` |
| AI | suggestion raised | `AiSuggestionRaised` | `AiSuggestion` |
| AI | suggestion accepted | `AiSuggestionAccepted` | `AiSuggestion` |

## Condition groups

```text
relationship.owner == current_user
lead.temperature in [warm, hot]
lead.score >= configured_threshold
lead.source == expected_source
opportunity.stage changed_to configured_stage
opportunity.probability >= configured_probability
activity.type == meeting
campaign.response.type == positive_reply
case.priority in [high, urgent]
ai_suggestion.status == accepted
```

Conditions must evaluate against explicit read models or value objects. They must not introspect Doctrine entities inside controller actions.

## Action groups

| Action | Symfony surface | Result |
|---|---|---|
| assign owner | service | owner reference changed through business service |
| schedule task | Messenger | `TaskScheduled` |
| record activity | service | `ActivityRecorded` |
| rebuild timeline | Messenger | `BuildRelationshipTimelineMessage` |
| score lead | Messenger | `ScoreLeadMessage` |
| detect duplicate | Messenger | `DetectLeadDuplicateMessage` |
| transition opportunity | Messenger/service | `OpportunityStageChanged` |
| recalculate forecast | Messenger | `RecalculateOpportunityForecastMessage` |
| recalculate risk | Messenger | `RecalculateOpportunityRiskMessage` |
| rebuild campaign performance | Messenger | `RebuildCampaignPerformanceMessage` |
| recalculate case SLA | Messenger | `RecalculateCaseSlaMessage` |
| raise AI suggestion | service | `AiSuggestionRaised` |
| apply AI suggestion | service + audit | `AiSuggestionApplied` |

## Execution policy

```text
1. Business event is emitted.
2. AutomationTriggerMatcher selects candidate rules.
3. AutomationConditionEvaluator evaluates rule conditions.
4. AutomationActionExecutor dispatches safe business actions.
5. AutomationRun and AutomationRunStep record trace.
6. Any AI action creates AiSuggestion first unless explicitly approved by policy.
```

## Non-goals

```text
No CRUD route generation.
No CRUD controller generation.
No SQL-first automation engine.
No generic Created/Updated/Deleted events for Relating entities.
No direct AI mutation without suggestion/review/audit.
```
