# Inventory Discipline

The Relating skeleton uses a strict inventory discipline to keep cumulative archive waves reviewable.

## Inventory sources

```text
MANIFEST.json
README.md
docs/*
tests/*
tools/*
```

## Naming discipline

- Component name: `Relating`.
- Root object: `Relationship`.
- Market category: `CRM`.
- Symfony namespace: `App`.
- Test namespace: `App\Tests`.

## Forbidden release inventory

```text
src/Domain
migrations
vendor
node_modules
*.sql
*Bundle.php
CRUD controllers
CRUD route files
CRUD YAML declarations
```

## Review order

1. `README.md`
2. `docs/docs-entrypoint.md`
3. `docs/relating-canon.md`
4. `docs/boundary-adr-index.md`
5. `docs/canonical-object-matrix.md`
6. `docs/implementation-roadmap-final.md`
7. `docs/release-packaging-quality.md`
