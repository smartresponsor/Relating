# S12 Audit / Decision Trace Skeleton

Relating records business decision traces, not CRUD audit rows.

The trace layer exists to explain why a business lifecycle action was allowed, rejected, reviewed, applied, skipped, or failed.
It is intentionally separate from persistence implementation and from any global audit table owned by another component.

## Trace surfaces

- BusinessDecisionTrace
- PolicyDecisionTrace
- AiReviewTrace
- TransitionTrace
- NeighborSignalTrace

## Hard exclusions

- no CRUD audit route
- no audit-table SQL
- no EntityManager shortcut
- no lifecycle event named Created/Updated/Deleted
- no Accessing ownership
- no neighbor entity ownership
