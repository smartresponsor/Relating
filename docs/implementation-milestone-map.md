# Relating Implementation Milestone Map

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This roadmap converts the CRM source vacuum into executable Symfony milestones.

The plan is intentionally cumulative. Each milestone must preserve the no-CRUD boundary.

## M0: Skeleton stabilization

Goal: keep the current skeleton installable and lint-clean.

Deliverables:

```text
README
MANIFEST
routing boundary docs
object catalog
view catalog
source vacuum notes
install script
syntax tests
route boundary tests
```

Exit criteria:

```text
PHP lint green
ZIP integrity green
No CRUD route/controller/action names
App namespace only
No /src/Domain/
```

## M1: Relationship core

Goal: create the root relationship graph.

Objects:

```text
Relationship
RelationshipParticipant
RelationshipRelation
RelationshipSignal
TimelineEvent
Activity
ActivityTarget
```

Business operations:

```text
start relationship
relate vendor
record signal
build timeline
assign owner
calculate health score
```

Events:

```text
RelationshipStarted
RelationshipLinkedToVendor
RelationshipSignalRecorded
RelationshipHealthScoreChanged
TimelineRebuilt
```

Business routes:

```text
/relating/relationship/{relationshipId}/timeline/build
/relating/relationship/{relationshipId}/signal/record
/relating/relationship/{relationshipId}/health/recalculate
```

## M2: Lead lifecycle

Goal: capture and qualify untrusted business interest without polluting Vendoring.

Objects:

```text
Lead
LeadSource
LeadType
LeadQualification
LeadScore
LeadAssignment
LeadRejection
LeadConversion
DuplicateCandidate
MergeProposal
```

Business operations:

```text
capture lead
score lead
qualify lead
reject lead
detect duplicate
convert lead
link or create vendor reference
open opportunity
```

Business routes:

```text
/relating/lead/{leadId}/qualify
/relating/lead/{leadId}/reject
/relating/lead/{leadId}/score
/relating/lead/{leadId}/convert
/relating/duplicate/{candidateId}/review
```

## M3: Opportunity pipeline

Goal: model deal lifecycle without owning order/payment/product.

Objects:

```text
Pipeline
PipelineStage
Opportunity
OpportunityStageHistory
OpportunityContactRole
OpportunityProductInterest
OpportunityCompetitor
OpportunityLossReason
OpportunityForecast
QuoteIntent
QuoteLineIntent
CommercialTerm
DiscountApproval
```

Business operations:

```text
open opportunity
transition stage
record stage history
attach product interest
recalculate forecast
record loss reason
request discount approval
promote quote intent to order reference
```

Business routes:

```text
/relating/opportunity/{opportunityId}/transition
/relating/opportunity/{opportunityId}/forecast/recalculate
/relating/opportunity/{opportunityId}/risk/recalculate
/relating/quote-intent/{quoteIntentId}/approve-discount
```

## M4: Activity, task, and timeline

Goal: produce a unified relationship memory across messages, meetings, calls, tasks, notes, cases, and opportunities.

Objects:

```text
Activity
ActivityParticipant
ActivityTarget
Task
Note
Meeting
Call
Reminder
TimelineEvent
```

Business operations:

```text
complete task
log call
log meeting outcome
record note
schedule reminder
project external message thread into timeline
rebuild timeline
```

Business routes:

```text
/relating/activity/{activityId}/complete
/relating/task/{taskId}/complete
/relating/reminder/{reminderId}/snooze
/relating/relationship/{relationshipId}/timeline/build
```

## M5: Campaign, source, and attribution

Goal: track relationship acquisition and nurturing without becoming a marketing suite.

Objects:

```text
Source
UtmAttribution
Campaign
CampaignMember
CampaignTouch
CampaignResponse
TargetList
TargetListMember
```

Business operations:

```text
capture source
build target list
enroll campaign member
record campaign touch
capture campaign response
calculate first touch
calculate last touch
calculate influence score
```

Business routes:

```text
/relating/campaign/{campaignId}/member/enroll
/relating/campaign/{campaignId}/response/capture
/relating/campaign/{campaignId}/performance/rebuild
```

## M6: Case and escalation

Goal: represent customer/relationship issues, SLA pressure, and resolution history.

Objects:

```text
CaseRecord
CaseType
CaseStatus
CaseThread
CaseSla
CaseEscalation
CaseResolution
```

Business operations:

```text
open case
triage case
escalate case
resolve case
record SLA breach
attach message thread reference
attach document reference
```

Business routes:

```text
/relating/case/{caseId}/triage
/relating/case/{caseId}/escalate
/relating/case/{caseId}/resolve
/relating/case/{caseId}/sla/recalculate
```

## M7: Metadata and ViewObject registry

Goal: give Relating modern CRM configurability without legacy array magic.

Objects:

```text
RelatingObjectDefinition
RelatingFieldDefinition
RelatingFieldOption
RelatingRelationshipDefinition
RelatingLayoutDefinition
RelatingViewDefinition
RelatingViewFilter
RelatingViewSort
RelatingViewColumn
RelatingKanbanDefinition
RelatingCalendarDefinition
RelatingDashboardDefinition
```

Business operations:

```text
publish object definition
publish view definition
validate view contract
rebuild dashboard read model
```

Business routes:

```text
/relating/catalog
/relating/view/{viewId}/validate
/relating/dashboard/{dashboardId}/rebuild
```

## M8: Automation and AI suggestion layer

Goal: automate relationship work while preserving explicit audit and safe application.

Objects:

```text
AutomationRule
AutomationTrigger
AutomationCondition
AutomationAction
AutomationRun
AutomationRunStep
AutomationError
AiSuggestion
AiScoringRun
AiEnrichmentRun
AiDraft
AiDecisionLog
AiSignal
```

Business operations:

```text
run automation
evaluate trigger
execute action
create AI suggestion
review AI suggestion
apply AI suggestion
reject AI suggestion
write decision log
```

Business routes:

```text
/relating/automation/{automationRuleId}/run
/relating/ai-suggestion/{suggestionId}/apply
/relating/ai-suggestion/{suggestionId}/reject
/relating/ai-suggestion/{suggestionId}/explain
```

## M9: MVP integration boundary

Goal: integrate with neighbors through references and events only.

Neighbor surfaces:

```text
Vendoring: VendorReference
Accessing: AccessSubjectReference, access decision check
Messaging: MessageThreadReference, message signal import
Producting: ProductReference, product interest
Ordering: OrderReference, quote intent promotion
Payment: PaymentReference, contribution/payment signal
Shipment: ShipmentReference, fulfillment signal
Projecting: ProjectReference, delivery/project signal
Documentating/Media: DocumentReference, template references
```

Exit criteria:

```text
No neighbor entity ownership
No duplicate account/contact/product/order/payment/shipment/message tables
No direct CRUD route exposure
All external links are references or events
```
