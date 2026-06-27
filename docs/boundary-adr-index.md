# Boundary ADR Index

This index points future contributors to the canonical decisions already made for Relating.

## ADR-001: Relating owns Relationship, not CRUD

File: `docs/boundary-adr-001-relating-owns-relationship-not-crud.md`

Decision:

- Relating owns relationship lifecycle.
- CRUD remains outside Relating.
- Relating creates business handlers/routes only.

## ADR-002: CRM is market category, Relating is component name

Decision:

- Use `CRM` in README, UI labels, roadmap, tags, and product positioning.
- Use `App\Relating` in PHP namespace.
- Use `Relationship` as root object.

Rationale:

`Customer Relationship Management` contributes the core word `Relationship`. `Managing` is already a neighboring component concern, and `Customer` is a role around `Vendor`, not the canonical object owner.

## ADR-003: Vendor owns party identity

Decision:

- Relating does not create Account/Contact/Person/Company master data.
- Relating references Vendoring by scalar reference objects.
- Relating may track role, lifecycle, score, and relationship-specific profile data.

## ADR-004: AI is suggestion-first

Decision:

- AI can raise suggestions.
- AI suggestions must be reviewed, applied, rejected, or traced.
- AI does not silently mutate relationship state.

## ADR-005: ViewObjects are API boundary

Decision:

- API/View layer returns ViewObjects/read models.
- Doctrine entities must not leak into API payloads.
- Business views are not CRUD list/detail routes.

## ADR-006: Neighbor signals are normalized, not owned

Decision:

- Relating receives or resolves neighbor signals.
- Relating stores normalized references/signals.
- Relating does not own neighbor tables or neighbor lifecycle.

## ADR-007: EntityFirst before migration

Decision:

- Entity/value/enum design comes first.
- Host app generates migrations only after integration review.
- Skeleton does not ship generated migrations.
