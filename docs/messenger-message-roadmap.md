# Symfony Messenger Message Roadmap

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

Relating uses Messenger for asynchronous business work. Messages carry references and payloads, not Doctrine entities.

## Current message skeleton

```text
QualifyLeadMessage
ConvertLeadMessage
BuildTimelineMessage
AutomationRunRequestedMessage
RaiseAiSuggestionMessage
```

## Expanded message skeleton

```text
BuildRelationshipTimelineMessage
RecalculateRelationshipHealthMessage
ScoreLeadMessage
DetectLeadDuplicateMessage
TransitionOpportunityStageMessage
RecalculateOpportunityForecastMessage
RecalculateOpportunityRiskMessage
CaptureCampaignResponseMessage
RebuildCampaignPerformanceMessage
RecalculateCaseSlaMessage
RaiseAiSuggestionMessage
ReviewAiSuggestionMessage
ApplyAiSuggestionMessage
```

## Handler policy

Handlers must:

```text
load by repository interfaces
call application services
emit business events
write audit records
return no HTTP response model
```

Handlers must not:

```text
act as CRUD controllers
execute raw SQL by default
serialize Doctrine entities
reach into neighboring components except through references/signals
```
