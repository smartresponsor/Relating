# S3 ViewObject contract correction

Relating exposes business output through ViewObjects only. Doctrine entities stay behind application services and repositories.

## Rules

1. Every output view implements `RelatingViewInterface`.
2. Every output view exposes a stable `surface()` code.
3. View payloads are scalar/array payloads only.
4. View payloads must not carry Doctrine entities or arbitrary objects.
5. API and business routes must return ViewObjects or serialized ViewObjects, never Entity objects.
6. ViewObjects describe business surfaces, not CRUD screens.

## Stable surfaces

- `relationship.summary`
- `relationship.profile`
- `relationship.timeline`
- `relationship.graph`
- `lead.list`
- `lead.detail`
- `lead.kanban`
- `lead.conversion`
- `opportunity.list`
- `opportunity.detail`
- `opportunity.board`
- `opportunity.forecast`
- `activity.timeline`
- `task.board`
- `campaign.performance`
- `campaign.response`
- `case.queue`
- `case.detail`
- `ai.suggestion_review`
- `ai.next_best_action`
- `automation.run`
- `metadata.schema`
- `dashboard`

## Anti-leakage contract

`AbstractArrayView` rejects arbitrary objects in payloads. This is intentional. Neighbor objects must be represented by reference values converted to scalar arrays before they reach the View layer.
