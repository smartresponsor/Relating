# Documentation Entrypoint

Read this file first when working on Relating.

## Fast path

1. `README.md`
2. `docs/documentation-finalization-pack.md`
3. `docs/relating-canon.md`
4. `docs/boundary-adr-index.md`
5. `docs/implementation-roadmap-final.md`

## Boundary path

1. `docs/routing-boundary.md`
2. `docs/neighbor-ownership-boundary.md`
3. `docs/api-entity-leakage-boundary.md`
4. `docs/projector-boundary.md`
5. `docs/config-boundary-checklist.md`

## Source-vacuum path

1. `docs/open-source-vacuum-plan.md`
2. `docs/source-vacuum-final-report.md`
3. `docs/source-object-matrix.md`
4. `docs/source-coverage-report.md`
5. `docs/anti-pattern-rejection-catalog.md`

## Implementation path

1. `docs/entityfirst-correction-report.md`
2. `docs/repository-contract-correction.md`
3. `docs/service-contract-correction.md`
4. `docs/application-service-skeleton.md`
5. `docs/business-route-handler-skeleton.md`
6. `docs/messenger-routing-draft.md`
7. `docs/message-handler-skeleton.md`
8. `docs/read-model-projector-skeleton.md`
9. `docs/validation-policy-skeleton.md`
10. `docs/audit-decision-trace-skeleton.md`

## Regression path

Run boundary tests after every wave:

- route boundary;
- event boundary;
- contract boundary;
- view boundary;
- neighbor boundary;
- config boundary;
- messenger boundary;
- read-model boundary;
- validation/policy boundary;
- audit/trace boundary.

## Wave S16 final skeleton gap review

S16 adds the pre-install release-candidate cleanup path:

```text
docs/final-gap-review.md
docs/naming-cleanup-report.md
docs/obsolete-term-scan.md
docs/duplicate-concept-review.md
docs/docs-link-integrity.md
docs/preinstall-rc-checklist.md
docs/s16-final-gap-review-report.md
tools/validate-relating-final-gap.ps1
tests/Relating/RelatingFinalGapBoundaryTest.php
```

Use this path before the first extraction into a real workspace. The S16 cleanup also removes CRUD-like terms from `src/Relating` production code where they could imply ownership of generic mutation surfaces.
