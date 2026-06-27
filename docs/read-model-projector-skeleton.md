# S10 Read Model / Projector Skeleton

Relating read models are business projections, not CRUD resources.

They exist to expose stable business surfaces for timeline, forecast, risk, campaign performance, SLA, and relationship health without leaking Doctrine entities or neighbor-owned records.

## Canon

- EntityFirst remains the write-side model.
- Read models are projection outputs.
- ViewObjects wrap read models for API/UI output.
- Projectors use business references and business events/signals.
- No direct SQL is introduced in this skeleton.
- No CRUD route, controller, YAML declaration, or action is introduced.

## Projection surfaces

- relationship timeline
- opportunity forecast
- opportunity risk
- campaign performance
- case SLA
- relationship health

## Naming

Allowed names use business verbs:

- project
- rebuild
- recalculate
- publish
- review

Forbidden names remain CRUD verbs:

- create
- update
- delete
- remove
- save
- persist
- flush
