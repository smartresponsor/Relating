# Relating Event and Message Catalog

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This catalog defines business events and async messages for Relating.

It is not an integration adapter plan and not a CRUD event list.

## Relationship events

```text
RelationshipStarted
RelationshipLinkedToVendor
RelationshipParticipantAdded
RelationshipParticipantDetached
RelationshipRelationLinked
RelationshipSignalRecorded
RelationshipHealthScoreChanged
RelationshipLifecycleStageChanged
RelationshipOwnerAssigned
RelationshipTimelineRebuildRequested
RelationshipTimelineRebuilt
```

## Lead events

```text
LeadCaptured
LeadEnriched
LeadAssigned
LeadScoreCalculated
LeadQualified
LeadRejected
LeadDuplicateCandidateDetected
LeadMergeProposalRaised
LeadConverted
LeadLinkedToVendor
LeadOpportunityOpened
```

## Opportunity events

```text
OpportunityOpened
OpportunityStageTransitionRequested
OpportunityStageChanged
OpportunityProductInterestAdded
OpportunityCompetitorRecorded
OpportunityForecastRecalculated
OpportunityRiskScoreChanged
OpportunityWon
OpportunityLost
OpportunityLossReasonRecorded
QuoteIntentDrafted
DiscountApprovalRequested
```

## Activity and timeline events

```text
ActivityRecorded
ActivityCompleted
TaskScheduled
TaskCompleted
TaskOverdue
NoteRecorded
MeetingLogged
CallLogged
ReminderScheduled
ReminderSnoozed
MessageThreadLinked
TimelineRecordProjected
TimelineRebuildRequested
```

## Campaign and attribution events

```text
SourceCaptured
TargetListBuilt
TargetListMemberAdded
CampaignStarted
CampaignMemberEnrolled
CampaignTouchRecorded
CampaignResponseCaptured
CampaignAttributionRecalculated
CampaignPerformanceRebuilt
```

## Case events

```text
CaseOpened
CaseTriaged
CaseAssigned
CaseEscalated
CaseSlaCalculated
CaseSlaBreached
CaseMessageThreadLinked
CaseDocumentLinked
CaseResolved
CaseClosed
```

## Metadata/view events

```text
RelatingObjectDefinitionPublished
RelatingFieldDefinitionPublished
RelatingViewDefinitionPublished
RelatingLayoutDefinitionPublished
RelatingDashboardRebuildRequested
RelatingDashboardRebuilt
RelatingViewContractValidated
```

## Automation and AI events

```text
AutomationRunRequested
AutomationRunStarted
AutomationRunStepCompleted
AutomationRunFailed
AutomationRunCompleted
AiSuggestionRaised
AiSuggestionReviewed
AiSuggestionAccepted
AiSuggestionRejected
AiSuggestionApplied
AiDecisionLogged
AiSignalRecorded
```

## Message classes

Recommended Symfony Messenger message skeleton:

```text
BuildRelationshipTimelineMessage
RecalculateRelationshipHealthMessage
ScoreLeadMessage
DetectLeadDuplicateMessage
ConvertLeadMessage
TransitionOpportunityStageMessage
RecalculateOpportunityForecastMessage
RecalculateOpportunityRiskMessage
CaptureCampaignResponseMessage
RebuildCampaignPerformanceMessage
RecalculateCaseSlaMessage
RunRelatingAutomationMessage
ReviewAiSuggestionMessage
ApplyAiSuggestionMessage
```

## Event policy

Events must be:

```text
business-named
immutable after dispatch
traceable by tenant/user/source
safe to replay when marked replayable
free of raw Doctrine entities
based on IDs and value objects
```

Events must not be:

```text
Created
Updated
Deleted
Saved
Patched
GenericCrudOperationCompleted
```

Generic CRUD event names are forbidden inside Relating because they blur the business boundary.
Use `RelationshipStarted`, `OpportunityOpened`, `LeadCaptured`, `QuoteIntentDrafted`, and `AiSuggestionRaised` instead.
