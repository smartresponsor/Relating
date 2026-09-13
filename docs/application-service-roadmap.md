# Application Service Roadmap

This roadmap turns Relating skeleton contracts into implementation milestones while preserving the no-CRUD boundary.

## AS1 Relationship lifecycle

- `RelationshipStarterInterface`
- `RelationshipLifecycleServiceInterface`
- `RelationshipHealthScorerInterface`
- emits: `RelationshipStarted`, `RelationshipLinkedToVendor`, `RelationshipLifecycleStageChanged`, `RelationshipHealthScoreChanged`

## AS2 Lead lifecycle

- `LeadCaptureServiceInterface`
- `LeadEnrichmentServiceInterface`
- `LeadQualifierInterface`
- `LeadConverterInterface`
- emits: `LeadCaptured`, `LeadEnriched`, `LeadQualified`, `LeadConverted`, `LeadLinkedToVendor`, `LeadOpportunityOpened`

## AS3 Opportunity lifecycle

- `OpportunityOpenerInterface`
- `OpportunityStageTransitionInterface`
- emits: `OpportunityOpened`, `OpportunityStageTransitionRequested`, `OpportunityStageChanged`, `OpportunityWon`, `OpportunityLost`

## AS4 Activity and timeline

- `ActivityRecorderInterface`
- `ActivityTimelineBuilderInterface`
- `RelationshipTimelineProjectorInterface`
- emits: `ActivityRecorded`, `TimelineRecordProjected`, `RelationshipTimelineRebuildRequested`, `RelationshipTimelineRebuilt`

## AS5 Signals from neighbors

- `RelationshipSignalIngestorInterface`
- accepts business signals from Vendoring, Messaging, Ordering, Payment, Shipment, Producting, Projecting, Documentating, Accessing.
- emits: `RelationshipSignalRecorded`, then optionally `AiSignalRecorded`, `DuplicateCandidateDetected`, or lifecycle-specific events.

## AS6 Automation and AI

- `AutomationTriggerMatcherInterface`
- `AutomationConditionEvaluatorInterface`
- `AutomationActionExecutorInterface`
- `RelatingAutomationRunnerInterface`
- `RelatingAiSuggestionServiceInterface`
- `AiSuggestionReviewerInterface`
- emits only business events and never CRUD events.
