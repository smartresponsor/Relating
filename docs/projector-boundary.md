# Projector Boundary

Projectors convert business signals into read models. They do not become repositories, controllers, or CRUD handlers.

## Allowed

- consume business messages
- consume normalized neighbor signals
- produce read model payloads
- publish projection results
- rebuild business projections

## Forbidden

- CRUD controllers
- CRUD routes
- CRUD YAML route declarations
- direct SQL in the skeleton
- EntityManager shortcuts in the skeleton
- exposing Doctrine entities in ViewObjects
- owning neighbor component records

## SQL note

Large reporting or aggregation queries may be introduced later as explicit read-model infrastructure, but only behind approved query services and only after the EntityFirst model and boundary ADRs are installed. S10 does not introduce those implementations.
