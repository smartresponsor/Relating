# Relating Canon

## Name

`Relating` is the Symfony component name.

`Relationship` is the root business object.

`CRM` is the market category and UI grouping label, not the namespace.

## Namespace

```text
App
```

No alternative namespace is allowed.

## Responsibility

Relating owns the business lifecycle of relationships:

- relationship start and lifecycle stage;
- lead capture, qualification, enrichment, conversion;
- opportunity opening, stage transition, forecast, risk;
- activity recording and timeline projection;
- campaign/source attribution;
- case triage, SLA projection, escalation signal;
- AI suggestion lifecycle;
- business decision traces.

## Non-responsibility

Relating does not own:

- CRUD mechanism;
- Vendor master data;
- Product master data;
- Order ownership;
- Payment ownership;
- Shipment ownership;
- Access/security rule ownership;
- Message storage;
- Document/media storage;
- Project ownership.

## Naming

Use business lifecycle names:

- `RelationshipStarted`
- `LeadCaptured`
- `LeadQualified`
- `LeadConverted`
- `OpportunityOpened`
- `OpportunityStageTransitioned`
- `ActivityRecorded`
- `TimelineProjected`
- `AiSuggestionRaised`
- `AiSuggestionReviewed`

Avoid CRUD names:

- `Created`
- `Updated`
- `Deleted`
- `Saved`
- `Removed`
- `Listed`
- `Shown`

## Object rule

`Account`, `Contact`, `Person`, and `Company` from external CRM systems are normalized to `VendorReference` or relationship participation. They are not recreated as Relating-owned master-data entities.
