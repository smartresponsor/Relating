# Source Vacuum Final Report

The vacuum stage has been completed as a documentation and architecture harvesting pass. It intentionally avoids source-code copying.

## Source coverage

| Source | Used for | Relating normalization |
| --- | --- | --- |
| Twenty | objects, fields, records, views, workflows, agents | metadata, view registry, workflow/AI concepts |
| EspoCRM | entity manager, relationships, layout manager, roles | field/layout/view definitions and payload boundaries |
| SuiteCRM | broad CRM module catalog | object checklist and business chain coverage |
| OroCRM | lead/opportunity lifecycle, customer 360, campaigns | relationship profile, opportunity, forecast and campaign surfaces |
| Krayin | SMB lead pipeline, activities, attributes, quote/product intent | compact forms, attribute references, quote intent |
| CiviCRM | relationship graph, activities, cases, contributions/memberships/events | community/nonprofit relationship surfaces and reference signals |

## Accepted concepts

- Relationship lifecycle.
- Lead lifecycle.
- Opportunity pipeline.
- Activity timeline.
- Campaign/source attribution.
- Case/SLA triage.
- Metadata-driven view definitions.
- Workflow automation.
- AI suggestion lifecycle.
- Business decision trace.
- Dedupe/merge review surface.

## Rejected concepts

- Migrations-first model copying.
- SQL-first schema import.
- Account/Contact duplication.
- Fat module/controller style.
- Legacy module god-objects.
- CRUD route generation.
- AI direct mutation.
- Workflow magic without trace.
- Security duplication inside Relating.

## Final vacuum result

External CRM systems are now represented as canonical Relating docs, object matrix entries, view/API contracts, business route surfaces, workflow/message catalogs, neighbor references, validation/policy contracts, and trace/audit surfaces.
