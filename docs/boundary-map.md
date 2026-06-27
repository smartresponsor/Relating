# Relating Boundary Map

Relating is the CRM capability of SmartResponsor.

## Owned by Relating

- Relationship lifecycle
- Lead capture, qualification, conversion
- Opportunity pipeline and stage history
- Activities, tasks, notes, calls, meetings
- Timeline projection around relationships
- Campaign membership and response tracking
- Case records and escalations
- Commercial intent before an order exists
- Metadata-driven views and layouts
- Automation rules and runs
- AI suggestions, scoring, enrichment, drafts, and decision logs
- Duplicate candidates and merge proposals


## Route and controller boundary

Relating owns business routes only. It does not own CRUD routing.

CRUD operations are intentionally excluded from this component skeleton:

- no CRUD controllers;
- no CRUD action methods;
- no CRUD YAML route declarations;
- no CRUD attribute routes;
- no `index`, `create`, `read`, `update`, or `delete` route actions;
- no replacement of the existing CRUD route engine.

The route surface is limited to business capabilities such as lead qualification, lead conversion, opportunity stage transition, relationship timeline building, duplicate review, campaign response capture, automation execution, AI suggestion review, and object catalog/read-model views.

If a source CRM exposes an object through ordinary CRUD routes, Relating records only the business meaning of that object. CRUD exposure remains outside Relating.

## Referenced neighbors

- Vendoring: `VendorReference`
- Accessing: `AccessSubjectReference`
- Producting / Production: `ProductReference`
- Ordering: `OrderReference`
- Payment: `PaymentReference`
- Shipment: `ShipmentReference`
- Messaging: `MessageThreadReference`
- Projecting: `ProjectReference`
- Managing: operational UI/backoffice ownership

## Naming canon

```text
Market category: CRM
Component: Relating
Root entity: Relationship
Action verb: relate
```
