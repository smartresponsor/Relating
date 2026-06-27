# S7 Business Route Report

S7 added the HTTP business route handler skeleton. The implementation uses Symfony attribute routes, but every route is a business route, not a CRUD route.

## Added controller support

- BusinessRequestPayload
- BusinessResultPayload
- StartRelationshipController
- CaptureLeadController
- QualifyLeadController
- ConvertLeadController
- OpenOpportunityController
- TransitionOpportunityStageController
- RecordActivityController
- ProjectTimelineController
- ReviewAiSuggestionController

## Guardrail

The existing route boundary test scans route declarations and controller action names. S7 adds a stricter business route surface test that rejects CRUD-like paths or names.
