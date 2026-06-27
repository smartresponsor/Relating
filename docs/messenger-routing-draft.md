# Messenger routing draft

Relating async routing is intentionally declared as a draft `.dist` file.
The host application decides whether these messages go to `async`, `relating`,
`low_priority`, or another transport.

## Business message groups

### Lead lifecycle

```text
QualifyLeadMessage
ConvertLeadMessage
DetectLeadDuplicateMessage
```

### Timeline and relationship projections

```text
BuildRelationshipTimelineMessage
BuildTimelineMessage
RecalculateRelationshipHealthMessage
```

### Opportunity analytics

```text
RecalculateOpportunityForecastMessage
RecalculateOpportunityRiskMessage
```

### Case and campaign projections

```text
RecalculateCaseSlaMessage
CaptureCampaignResponseMessage
RebuildCampaignPerformanceMessage
```

### AI suggestion lifecycle

```text
RaiseAiSuggestionMessage
ReviewAiSuggestionMessage
ApplyAiSuggestionMessage
```

## Hard boundary

No CRUD-derived messages are allowed. If a future source project has an event like
`ContactCreated`, `AccountUpdated`, or `LeadDeleted`, it must be translated into a
Relating business signal, not copied as-is.
