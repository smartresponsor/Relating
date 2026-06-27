# S9 Report: Message Handler Skeleton

S9 adds Symfony Messenger handler skeletons for approved Relating business messages.

## Added

- `src/MessageHandler/*`
- `BusinessMessagePayload` validation helper
- additional business service contracts for scoring/rebuild/recalculation surfaces
- message handler service wiring in `config/services/relating.yaml.dist`
- complete business-message routing draft in `config/packages/relating_messenger.yaml.dist`
- boundary tests for handler naming and routing coverage

## Boundary

No CRUD routes, controllers, handler names, generic persistence handlers, migrations, direct SQL, or neighbor ownership were added.
