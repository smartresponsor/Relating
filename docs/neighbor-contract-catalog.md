# Neighbor Contract Catalog

Relating is a CRM-oriented relationship lifecycle component. It works next to neighboring SmartResponsor components through explicit reference value objects and business signals.

## Hard ownership rule

Relating owns relationship lifecycle objects. It does not own external master data or operational fulfillment objects.

| Neighbor | Owns | Relating may store |
|---|---|---|
| Vendoring | Vendor identity, person/company/vendor profiles | VendorReference, RelationshipParticipant, RelationshipRelation |
| Accessing | user, role, permission, visibility, security decisions | AccessSubjectReference, visibility hints only |
| Assessing | scoring/evaluation outside CRM lifecycle | score reference or imported signal |
| Managing | admin/backoffice orchestration | dashboard/view references |
| Producting / Production | product catalog and product lifecycle | ProductReference, OpportunityProductInterest |
| Ordering | order lifecycle | OrderReference, order-related timeline signal |
| Payment | payments, invoices, payment state | PaymentReference, payment-related relationship signal |
| Shipment | shipment, delivery, tracking | ShipmentReference, shipment-related relationship signal |
| Messaging | email/message/thread content and transport | MessageThreadReference, CampaignTouch, ActivityTarget |
| Projecting | project execution | ProjectReference, project relationship signal |
| Documentating / Media | documents, files, templates | DocumentReference, DocumentTemplateReference |

## Allowed Relating responsibilities

```text
capture relationship signal
build relationship timeline
qualify lead
convert lead into vendor reference + opportunity
transition opportunity stage
score relationship health
review duplicate candidate
prepare next best action
summarize relationship history
link activity to neighboring references
```

## Forbidden Relating responsibilities

```text
create vendor master record directly through CRUD
own product catalog
own order fulfillment
own payment accounting
own shipment tracking
own message transport
own access policy engine
own project execution
own document storage
own CRUD controllers/routes/YAML declarations
```

## Integration shape

Neighbor interactions should be expressed as value references, events, or application service calls. Relating should not import neighboring persistence models as Doctrine associations unless the host application explicitly decides that boundary is safe.
