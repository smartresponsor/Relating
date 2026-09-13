# S7 Business Route Handler Skeleton

Relating exposes only business HTTP route handlers. These handlers map JSON request payloads to application command objects and return normalized business action results. They do not expose CRUD semantics.

## Approved business routes

| Route | Method | Application service | Business action |
|---|---:|---|---|
| `/relating/catalog` | GET | static catalog handler | catalog |
| `/relating/relationship/start` | POST | StartRelationshipApplicationService | relationship-start |
| `/relating/lead/capture` | POST | CaptureLeadApplicationService | lead-capture |
| `/relating/lead/qualify` | POST | QualifyLeadApplicationService | lead-qualification |
| `/relating/lead/convert` | POST | ConvertLeadApplicationService | lead-conversion |
| `/relating/opportunity/open` | POST | OpenOpportunityApplicationService | opportunity-open |
| `/relating/opportunity/stage/transition` | POST | TransitionOpportunityStageApplicationService | opportunity-stage-transition |
| `/relating/activity/record` | POST | RecordActivityApplicationService | activity-record |
| `/relating/timeline/project` | POST | ProjectTimelineApplicationService | timeline-projection |
| `/relating/ai/suggestion/review` | POST | ReviewAiSuggestionApplicationService | ai-review |

## Hard boundary

The controller layer must not provide generic entity operations. The route names and paths must stay business-named and must not include index, create, read, update, delete, list, show, edit, store, patch, or remove actions.

CRUD remains owned by the existing SmartResponsor CRUD mechanism. Relating only publishes lifecycle/business operations.
