# S10 Read Model Report

S10 adds a business projection skeleton for Relating.

## Added code

- `src/Relating/ReadModel/*`
- `src/Relating/Service/ReadModel/*`
- read-model projection ViewObjects
- read-model boundary test

## Added docs

- read model / projector skeleton
- read model catalog
- projector boundary

## Guardrails

- No CRUD route surface.
- No CRUD controller surface.
- No CRUD YAML surface.
- No migration files.
- No direct SQL.
- No neighbor ownership.
- No Doctrine entity leakage in read model payloads or projection views.
