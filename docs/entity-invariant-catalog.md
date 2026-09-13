# Entity invariant catalog

## Relationship

- Always points to one canonical `VendorReference`.
- Owns relationship kind, status, lifecycle stage and scores.
- Does not own Vendor data.
- Lifecycle transitions are business transitions, not CRUD updates.

## Lead

- May exist before a Vendor is created or linked.
- Can be qualified, disqualified, marked duplicate or converted.
- Conversion links to `Relationship`, not directly to CRUD Account/Contact records.

## Opportunity

- Always belongs to a `Relationship`.
- Uses pipeline/stage references.
- Owns amount, probability, expected close date, forecast category and loss reason.
- Product is represented only by `ProductReference`.

## Activity

- Targets any Relating-owned object or neighboring reference by typed target.
- Can be planned, started, completed or cancelled.
- Does not own Messaging records.

## TimelineRecord

- Append-style history projection.
- Uses business event kinds, not CRUD event names.
- Can point to source component/reference for neighboring events.

## CaseRecord

- Belongs to a Relationship.
- Owns status, priority, SLA status/deadline and resolution timestamp.
- Does not become a full helpdesk component in S1.
