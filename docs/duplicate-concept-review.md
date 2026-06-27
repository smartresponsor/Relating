# S16 Duplicate Concept Review

Relating intentionally avoids duplicating neighboring component responsibilities.

## Deduplicated concepts

| Market/source CRM concept | Relating treatment | Owner |
| --- | --- | --- |
| Account | VendorReference | Vendoring |
| Contact | VendorReference plus RelationshipParticipant | Vendoring + Relating role only |
| Product | ProductReference / product interest | Producting or Production |
| Order | OrderReference / signal | Ordering |
| Payment | PaymentReference / signal | Payment |
| Shipment | ShipmentReference / signal | Shipment |
| Message | MessageThreadReference / signal | Messaging |
| Access rule | AccessSubjectReference / policy result | Accessing |
| Project | ProjectReference / signal | Projecting |
| Document | DocumentReference | Documentating / Media |

## Relating-owned concepts

Relating owns relationship lifecycle, lead lifecycle, opportunity pipeline, activity/timeline, campaigns, cases, automation, AI suggestion review, read models, and decision traces.
