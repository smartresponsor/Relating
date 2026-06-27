# Service Contract Correction

Relating service contracts use use-case language, not CRUD or technical storage language.

## Correct examples

```text
startRelationshipForVendor
captureLeadFromBusinessSignal
enrichLeadWithVerifiedSignals
qualifyLeadForRelationship
convertQualifiedLeadToRelationship
openOpportunityForRelationship
transitionOpportunityToStage
recordBusinessActivity
projectBusinessEvent
ingestNeighborSignal
scoreRelationshipHealth
suggestNextActionsForRelationship
```

## Rejected examples

```text
createLead
updateOpportunity
deleteActivity
saveRelationship
handleCrudRequest
```

## Boundary

Services may orchestrate neighboring references such as VendorReference, ProductReference, OrderReference, PaymentReference, ShipmentReference, MessageThreadReference, ProjectReference, DocumentReference, and AccessSubjectReference.

Services must not recreate those neighboring entities and must not expose CRUD routes or CRUD controllers.
