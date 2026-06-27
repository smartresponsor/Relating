# S5 Demo seed readiness

`Relating` demo data is intentionally business-lifecycle oriented. It is not a CRUD seed and it must not create CRUD controllers, CRUD routes, CRUD YAML declarations, or CRUD action names.

## Purpose

The S5 seed layer gives a safe demo baseline for validating the Relating boundary before real persistence and application services are wired.

It covers:

- relationship-start
- lead-capture
- lead-qualification
- lead-conversion
- opportunity-open
- opportunity-stage-transition
- timeline-projection
- ai-review

## Non-goals

The seed layer does not:

- create database migrations
- call Doctrine directly
- provide CRUD fixtures
- expose list/detail CRUD API surfaces
- generate Account, Contact, Vendor, Product, Order, Payment, Shipment, Message, Access, or Project entities

## Canon

Demo data must be created through business scenarios and business operations only.

Allowed examples:

- `start_relationship`
- `capture_lead`
- `qualify_lead`
- `convert_lead`
- `open_opportunity`
- `change_stage`
- `project_timeline_event`
- `raise_ai_suggestion`
- `review_ai_suggestion`

Forbidden examples:

- `index`
- `create`
- `read`
- `update`
- `delete`
- `list`
- `show`
- `edit`

## Runtime shape

The demo layer is deliberately dependency-light:

- `RelatingDemoSeed` describes scenario metadata.
- `RelatingDemoScenario` guards scenario operation names.
- `RelatingDemoEntityFactory` constructs in-memory EntityFirst objects without persisting them.
- `DemoScenarioView` exposes scalar-only view payloads.
