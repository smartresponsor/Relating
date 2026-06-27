# S6 Application Service Skeleton

`Relating` application services orchestrate business use-cases only. They do not expose generic CRUD actions and they do not own persistence outside repository contracts.

## Services

| Business flow | Command | Application service | Result action |
|---|---|---|---|
| Start relationship | `StartRelationshipCommand` | `StartRelationshipApplicationService::startRelationship()` | `relationship-start` |
| Capture lead | `CaptureLeadCommand` | `CaptureLeadApplicationService::captureLead()` | `lead-capture` |
| Qualify lead | `QualifyLeadCommand` | `QualifyLeadApplicationService::qualifyLead()` | `lead-qualification` |
| Convert lead | `ConvertLeadCommand` | `ConvertLeadApplicationService::convertLead()` | `lead-conversion` |
| Open opportunity | `OpenOpportunityCommand` | `OpenOpportunityApplicationService::openOpportunity()` | `opportunity-open` |
| Transition opportunity stage | `TransitionOpportunityStageCommand` | `TransitionOpportunityStageApplicationService::transitionOpportunityStage()` | `opportunity-stage-transition` |
| Record activity | `RecordActivityCommand` | `RecordActivityApplicationService::recordActivity()` | `activity-record` |
| Project timeline | `ProjectTimelineCommand` | `ProjectTimelineApplicationService::projectTimeline()` | `timeline-project` |
| Review AI suggestion | `ReviewAiSuggestionCommand` | `ReviewAiSuggestionApplicationService::reviewAiSuggestion()` | `ai-review` |

## Boundary

Application services may coordinate entities, repositories, business events, Messenger messages, and neighbor references. They must not define `index`, `show`, `list`, `read`, `store`, `save`, `edit`, `patch`, `put`, `remove`, or `delete` operations.

CRUD responsibility remains outside `Relating`.
