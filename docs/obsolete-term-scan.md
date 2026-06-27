# S16 Obsolete Term Scan

The scan focuses on code-bearing paths, not explanatory documentation that intentionally lists forbidden terms.

## Code paths scanned

- `src/Relating`
- `config`
- `tests/Relating`

## Forbidden production-code terms

The following terms must not appear in `src/Relating` as class names, enum values, service names, or business method names:

```text
Create
Update
Delete
Remove
Removed
MassUpdate
mass_update
EntityManagerInterface
SELECT
INSERT
UPDATE
DELETE
```

## Result

The S16 cleanup leaves `src/Relating` free from those obsolete implementation terms.

Documentation and tests may still mention forbidden terms when documenting or asserting the boundary.
