# Relating ViewObject Roadmap

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

Relating exposes ViewObjects and read models. Doctrine entities must not be exposed directly by controllers or serialized as API contracts.

## Relationship views

```text
RelationshipSummaryView
RelationshipDetailView
RelationshipProfileView
RelationshipTimelineView
RelationshipGraphView
RelationshipSidePanelView
RelationshipRelatedPanelView
RelationshipSignalView
RelationshipHealthView
```

## Lead views

```text
LeadListView
LeadDetailView
LeadKanbanCardView
LeadQualificationView
LeadConversionView
LeadDuplicateReviewView
LeadSourceAttributionView
```

## Opportunity views

```text
OpportunityListView
OpportunityDetailView
OpportunityKanbanCardView
OpportunityBoardView
OpportunityForecastView
OpportunityStageHistoryView
OpportunityProductInterestView
OpportunityRiskView
```

## Activity/timeline views

```text
ActivityTimelineView
ActivityCalendarView
TaskBoardView
CallSummaryView
MeetingSummaryView
NoteThreadView
ReminderQueueView
```

## Campaign views

```text
CampaignPerformanceView
CampaignMemberView
TargetListView
CampaignTouchView
CampaignResponseView
AttributionView
```

## Case views

```text
CaseQueueView
CaseDetailView
CaseThreadView
CaseSlaView
CaseEscalationView
CaseResolutionView
```

## Metadata/layout views

```text
ObjectSchemaView
LayoutSchemaView
RelatingViewDefinitionView
RelatingFieldDefinitionView
RelationshipDefinitionView
ViewFilterDefinitionView
```

## AI/automation views

```text
AiSuggestionReviewView
AiDecisionLogView
AutomationRuleView
AutomationRunView
AutomationRunStepView
NextBestActionView
```

## Controller rule

Business controllers can return these ViewObjects, but they must not implement CRUD controller responsibilities.
