# Business Contract Naming Catalog

Relating naming must make the business state transition visible.

## Repository mutation names

```text
rememberStarted
rememberCaptured
rememberQualified
rememberConverted
rememberOpened
rememberStageChanged
rememberForecastRecalculated
rememberWon
rememberLost
rememberRecorded
rememberProjected
rememberRaised
rememberReviewed
rememberApplied
rememberPublished
```

## Service use-case names

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
rebuildAttributionForRelationship
triageCaseForRelationship
```

## Forbidden generic names

```text
create
read
update
delete
index
save
persist
remove
flush
handleCrud
```

Generic read names like `findById` are also avoided in the public skeleton contracts. Prefer business-scoped names like `relationshipOf`, `leadOf`, `opportunityOf`, and `timelineForTarget`.
