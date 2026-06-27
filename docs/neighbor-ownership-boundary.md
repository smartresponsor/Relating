# Neighbor Ownership Boundary

Relating owns relationship lifecycle. It never becomes a substitute repository for neighboring components.

## Relating-owned objects

```text
Relationship
RelationshipParticipant
RelationshipSignal
Lead
LeadQualification
LeadConversion
Opportunity
Pipeline
PipelineStage
Activity
TimelineEvent
Campaign
TargetList
CaseRecord
QuoteIntent
Relating object/view/layout/workflow metadata
AutomationRun
AiSuggestion
```

## Neighbor-owned objects

```text
Vendor
Access
User/operator profile
Product
Order
Payment
Shipment
Message
Project
Document
Membership
Contribution
Event
```

## Storage rule

Relating stores references and signal snapshots only when they are needed for relationship lifecycle, timeline, scoring, attribution, or automation review.

Relating does not store replicated source-of-truth records.

## Query rule

For normal business flows, Relating services operate on its own entities and scalar references. Cross-component data enrichment belongs in application-level orchestration, read models, projections, or API composition. Direct SQL joins across component ownership boundaries are forbidden in the skeleton.
