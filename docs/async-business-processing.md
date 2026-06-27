# Async Business Processing

Relating uses Messenger for asynchronous business processing only.

Allowed async work:

- scoring
- duplicate detection
- risk/forecast recalculation
- timeline projection
- campaign performance rebuild
- SLA recalculation
- AI suggestion lifecycle
- automation runs

Forbidden async work:

- generic entity creation
- generic entity update
- generic entity deletion
- direct SQL batch mutation
- neighbor component ownership mutation

Neighbor components must be contacted through explicit references/signals, not through owned Relating entities.
