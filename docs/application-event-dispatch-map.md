# Application Event Dispatch Map

Application services record business events after successful business transitions.

| Flow | Main event | Supporting events |
|---|---|---|
| relationship-start | `RelationshipStarted` | `RelationshipOwnerAssigned` |
| lead-capture | `LeadCaptured` | none |
| lead-qualification | `LeadQualified` | none |
| lead-conversion | `LeadConverted` | `LeadLinkedToVendor`, `LeadOpportunityOpened`, optional `RelationshipStarted` |
| opportunity-open | `OpportunityOpened` | none |
| opportunity-stage-transition | `OpportunityStageChanged` | none |
| activity-record | `ActivityRecorded` | none |
| timeline-project | `TimelineRecordProjected` | none |
| ai-review | `AiSuggestionReviewed` | `AiSuggestionAccepted` or `AiSuggestionRejected` |

The event map is intentionally business-named. Generic entity lifecycle events are rejected.
