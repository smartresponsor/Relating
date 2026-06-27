# S1 EntityFirst correction report

S1 turns the Relating skeleton from broad object inventory into Doctrine-ready business entities.

## Scope

S1 corrected the high-impact aggregate roots and business entities:

- `Relationship`
- `Lead`
- `Opportunity`
- `Pipeline`
- `PipelineStage`
- `Activity`
- `TimelineEvent`
- `Campaign`
- `CaseRecord`
- `RelationshipParticipant`
- `RelationshipSignal`

## Canon preserved

Relating remains the CRM market capability and the Symfony component name. `Relationship` remains the root object.

Relating still does not own:

- CRUD routes
- CRUD controllers
- CRUD YAML route declarations
- Vendor master data
- Product master data
- Order, Payment, Shipment, Message, Access, Project master data

Those boundaries are represented only through references and business signals.

## EntityFirst changes

S1 adds:

- stricter entity invariants;
- lower-case business codes;
- relationship lifecycle stages;
- relationship participants and signals;
- opportunity forecast category;
- lead conversion status;
- activity direction;
- campaign channel;
- case SLA status;
- tenant-aware Doctrine indexes.

No migration is generated in S1. Doctrine migration generation belongs to the host Symfony application after review.
