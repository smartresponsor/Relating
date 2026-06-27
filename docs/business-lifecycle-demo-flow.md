# Business lifecycle demo flow

The demo flow is designed as a thin executable narrative for the Relating skeleton.

```text
VendorReference exists in Vendoring
  -> RelationshipStarted
  -> LeadCaptured
  -> LeadQualified
  -> LeadConverted
  -> OpportunityOpened
  -> OpportunityStageChanged
  -> TimelineEventProjected
  -> AiSuggestionRaised
  -> AiSuggestionReviewed
```

## Neighbor boundaries

Relating may reference neighbor objects but must not recreate them.

```text
VendorReference        -> Vendoring
ProductReference       -> Producting / Production
OrderReference         -> Ordering
PaymentReference       -> Payment
ShipmentReference      -> Shipment
MessageThreadReference -> Messaging
AccessSubjectReference -> Accessing
ProjectReference       -> Projecting
```

## Demo use

The demo seed can be used by tests, documentation, CLI prototypes, or UI mock surfaces. It is not a DoctrineFixturesBundle dependency and it does not imply a persistence strategy.

## CRUD boundary

The demo flow must not introduce CRUD semantics. Even in sample data, operation names must describe business lifecycle behavior.
