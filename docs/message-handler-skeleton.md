# S9 Message Handler Skeleton

Relating message handlers are business lifecycle handlers for asynchronous work.

They are intentionally not CRUD handlers. They do not expose index/create/read/update/delete operations, they do not persist directly, and they do not issue SQL.

## Handler surfaces

- lead qualification
- lead conversion
- duplicate detection
- lead scoring
- opportunity stage transition
- relationship timeline build
- relationship health scoring
- opportunity forecast recalculation
- opportunity risk scoring
- case SLA recalculation
- campaign response capture
- campaign performance rebuild
- Relating automation run
- AI suggestion raise/review/apply

## Rule

Handlers call application services or business service contracts. They must not become repository/persistence shortcuts.
