# Application Command Catalog

Commands are immutable input DTOs for business flows. They are not HTTP request models and they are not CRUD forms.

## Commands

- `StartRelationshipCommand`
- `CaptureLeadCommand`
- `QualifyLeadCommand`
- `ConvertLeadCommand`
- `OpenOpportunityCommand`
- `TransitionOpportunityStageCommand`
- `RecordActivityCommand`
- `ProjectTimelineCommand`
- `ReviewAiSuggestionCommand`

## Rules

- Commands accept scalar references, never neighbor entities.
- Commands may carry context/payload arrays for CRM metadata and source-specific details.
- Commands do not declare database operations.
- Commands do not map one-to-one to CRUD routes.
