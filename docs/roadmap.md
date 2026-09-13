# Relating Roadmap

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This roadmap turns open-source CRM knowledge into a Symfony-first Relating implementation.

## Stage D - discovery vacuum

```text
D1 Twenty object/view/workflow/agent catalog
D2 EspoCRM entity/layout/relationship catalog
D3 SuiteCRM broad module and lifecycle catalog
D4 OroCRM customer-360 and commerce-adjacent CRM catalog
D5 Krayin SMB form/attribute/pipeline catalog
D6 CiviCRM nonprofit/community relationship catalog
D7 Anti-pattern and rejection catalog
```

Deliverable:

```text
docs/source-object-matrix.md
docs/source-analysis-notes.md
docs/source-decision-log.md
```

## Stage A - architecture normalization

```text
A1 Canonical object matrix
A2 Neighbor ownership matrix
A3 EntityFirst object design
A4 ViewObject and read-model design
A5 Business route surface only
A6 Repository and service contract normalization
A7 Event/message catalog
A8 Audit and AI-review rules
```

Deliverable:

```text
src/Entity
src/ValueObject
src/Snapshot/View
src/Repository
src/Service
src/Event
src/Message
```

## Stage S - skeleton completion

```text
S1 Complete entity list and remove duplicate/weak names
S2 Complete value object list
S3 Complete view object list
S4 Complete repository interface list
S5 Complete service contract list
S6 Complete business controllers and routes only
S7 Complete test skeleton and fixtures
S8 Complete README/ADR/source docs
S9 Generate Doctrine migration diff only after installation
S10 Validate no CRUD route or controller exists
```

## Stage M - MVP implementation

```text
M1 Relationship core
M2 Lead lifecycle
M3 Lead conversion to VendorReference + Opportunity
M4 Opportunity pipeline and stage transitions
M5 Activity, task, note, call, meeting timeline
M6 Business route controllers
M7 Dashboard/read-model views
M8 Tests and seed fixtures
```

## Stage P - production-grade Relating

```text
P1 Duplicate detection and merge proposal
P2 Campaign source and attribution
P3 Case/escalation/SLA
P4 Quote intent and commercial terms
P5 Metadata object/field/view registry
P6 Layout registry and view compiler
P7 Automation runner through Symfony Messenger
P8 AI suggestion and decision log
P9 Audit hardening
P10 Accessing integration
P11 Search and reporting read models
P12 Import/export mapping
```

## Stage L - leadership layer

```text
L1 Relationship intelligence score
L2 Next best action
L3 Opportunity risk
L4 Multi-touch influence
L5 Account/vendor graph visual view
L6 Timeline across Message, Order, Payment, Shipment, Producting, Projecting
L7 AI review queue
L8 Business outcome analytics
```

## Estimated waves

```text
Full skeleton v1: 8-12 waves
Working MVP: 18-25 waves
Production-grade Relating: 35-60 waves
```

## D3 — OroCRM / Krayin / CiviCRM Vacuum

Status: captured in cumulative archive.

Scope:

```text
OroCRM: lead qualification, opportunity workflow, forecast widgets, RFQ/quote intent surface.
Krayin: SMB pipeline, custom attributes, quick-add business capture, quote line intent.
CiviCRM: relationship graph, activities, membership/contribution/event references, search displays.
```

Output:

```text
docs/source-orocrm-vacuum.md
docs/source-krayin-vacuum.md
docs/source-civicrm-vacuum.md
docs/neighbor-contract-catalog.md
docs/business-route-surface.md
```

Next:

```text
A1 object matrix normalization
A2 boundary contract hardening
S1 EntityFirst correction plan
S2 ViewObject/API contract expansion
```

## A-wave architecture normalization

### A1 Canonical object matrix

Status: complete in `docs/canonical-object-matrix.md`.

Purpose: normalize Twenty/EspoCRM/SuiteCRM/OroCRM/Krayin/CiviCRM object names into SmartResponsor Relating/Vendoring/Accessing/Producting/Ordering/Payment/Shipment boundaries.

### A2 Boundary ADR

Status: complete in `docs/boundary-adr-001-relating-owns-relationship-not-crud.md`.

Purpose: record the hard decision that Relating owns relationship lifecycle business capabilities and never recreates CRUD routing.

### A3 Implementation milestone map

Status: complete in `docs/implementation-milestone-map.md`.

Purpose: split implementation into M0-M9 without mixing discovery, CRUD, persistence, UI, and business routes.

### A4 View API contract

Status: complete in `docs/view-api-contract.md`.

Purpose: require ViewObjects as API/UI contracts and block Doctrine entity leakage.

### A5 Event/message catalog

Status: complete in `docs/event-message-catalog.md`.

Purpose: define business events and Messenger messages without generic Created/Updated/Deleted CRUD events.

## A6 — Workflow / Automation Matrix

Goal: convert source CRM workflow concepts into a Symfony-native Relating automation skeleton.

Deliverables:

```text
automation trigger catalog
automation condition catalog
automation action catalog
business event catalog
Messenger message roadmap
AI suggestion lifecycle
automation guardrails
no-CRUD event boundary test
```

Acceptance:

```text
No generic RelationshipCreated/OpportunityCreated events.
No CRUD routes/controllers/YAML/actions.
Automation actions are business-named and traceable.
AI writes are mediated by suggestion/review/audit lifecycle.
```



## S4 — Neighbor reference contracts

Status: complete in skeleton.

Deliverables:

```text
neighbor reference contract docs
neighbor signal contract docs
neighbor ownership boundary
neighbor integration matrix
relationship signal normalization
neighbor reference/signal value objects
neighbor service contracts
neighbor boundary tests
```

Next: S5 test/fixture/demo-seed readiness without CRUD routes.
