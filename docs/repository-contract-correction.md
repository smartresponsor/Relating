# Repository Contract Correction

Relating repositories are persistence contracts for business lifecycle checkpoints, not generic CRUD gateways.

## Forbidden repository surface

Repository interfaces must not expose generic mutation methods:

```text
save
create
update
delete
remove
persist
flush
```

They also must not define CRUD route responsibilities. CRUD remains owned by the existing SmartResponsor CRUD mechanism.

## Required vocabulary

Repositories use lifecycle verbs that match Relating business events:

```text
rememberStarted
rememberCaptured
rememberQualified
rememberConverted
rememberOpened
rememberStageChanged
rememberRecorded
rememberProjected
rememberRaised
rememberReviewed
rememberPublished
```

Read-side methods should also be bounded by business intent:

```text
relationshipOf
relationshipForVendor
leadOf
opportunityOf
activeOpportunitiesForRelationship
openCasesForRelationship
pendingSuggestionsForTarget
timelineForTarget
```

## Rationale

The repository does not decide business behavior. Application services decide behavior and emit business events. Repository contracts only preserve the resulting business state or return business-scoped views of stored state.
