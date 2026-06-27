# S4 — Neighbor Reference Contracts

Relating is the CRM-oriented relationship lifecycle component. It does not own neighboring master data. Every interaction with a neighboring component is represented by a reference value object, a signal, a view payload, or a business message.

## Hard rule

Relating must not recreate neighboring objects as local entities.

| Neighbor | Owner component | Relating representation | Relating may do | Relating must not do |
|---|---|---|---|---|
| Vendor / party | Vendoring | `VendorReference`, `NeighborReference(vendoring, vendor, id)` | link relationship, lead conversion target, participant role | create Vendor, edit Vendor, duplicate Account/Contact |
| Access subject / permissions | Accessing / Assessing | `AccessSubjectReference` | request authorization context, store actor/owner reference | define permission source of truth |
| Manager / operator | Managing | `UserReference`, `NeighborReference(managing, operator, id)` | assign owner, route work | own user profile or admin identity |
| Product | Producting / Production | `ProductReference` | store product interest, quote intent, campaign affinity | create product catalog or stock |
| Order | Ordering | `OrderReference` | project order signal into timeline | create or mutate order |
| Payment | Payment | `PaymentReference` | project payment signal and risk | process payment or accounting |
| Shipment | Shipment | `ShipmentReference` | project fulfillment status | own shipping workflow |
| Message thread | Messaging | `MessageThreadReference` | connect timeline/activity to thread | send/own message persistence |
| Project | Projecting | `ProjectReference` | link relationship to delivery/project work | own project lifecycle |
| Document/template | Documentating / Media | `DocumentReference`, `DocumentTemplateReference` | attach reference, show view link | own document storage or rendering |

## Canonical reference contract

A neighbor reference is always stored as scalar component/kind/reference values. It is not a Doctrine association to a foreign component entity.

```text
NeighborReference
- component
- kind
- reference
```

This keeps Relating deployable as a skeleton without importing neighboring entities or their repositories.

## Allowed interaction modes

```text
reference only
incoming signal
outgoing business request
view projection
workflow trigger
AI suggestion context
```

## Disallowed interaction modes

```text
Doctrine relation to neighbor entity
foreign component CRUD controller
foreign component CRUD route
foreign component table ownership
SQL-first cross-component join
copy of Account/Contact/Product/Order/Payment/Shipment master data
```
