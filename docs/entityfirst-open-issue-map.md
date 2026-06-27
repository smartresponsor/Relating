# EntityFirst open issue map

## Pending S2 items

- Decide whether `Relationship` should reference exactly one primary Vendor or support multiple primary participants.
- Decide whether `Lead` raw payload should be immutable after conversion.
- Decide whether `OpportunityStageHistory` should be append-only and created only through a stage transition service.
- Decide whether `TimelineEvent` should be generated exclusively from business events.
- Decide whether `RelationshipSignal` should be consumed into score projections synchronously or through Messenger.

## Not allowed

- Do not solve these questions with CRUD routes.
- Do not create SQL schema manually.
- Do not introduce Account/Contact duplicates.
- Do not copy legacy CRM module structure into Symfony namespaces.
