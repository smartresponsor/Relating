# Neighbor Signal Contracts

Neighbor signals are business facts emitted by adjacent components and ingested by Relating as relationship context. They are not CRUD events.

## Incoming signal examples

| Source | Signal | Relating effect |
|---|---|---|
| Messaging | `message.received` | append timeline event, update last activity, raise next-best-action candidate |
| Messaging | `message.sent` | append timeline event, update engagement score |
| Ordering | `order.placed` | append commercial signal, improve relationship value score |
| Ordering | `order.cancelled` | append risk signal, potentially open case or risk review |
| Payment | `payment.failed` | append risk signal, update health score, raise follow-up action |
| Payment | `payment.succeeded` | append positive signal, update commercial history |
| Shipment | `shipment.delayed` | append service risk signal, potentially open case review |
| Producting / Production | `product.interest.detected` | attach product interest to relationship/opportunity |
| Accessing / Assessing | `access.revoked` | stop unsafe automation for affected subject |
| Managing | `owner.assigned` | update owner reference / assignment signal |
| Projecting | `project.milestone.reached` | append delivery signal |

## Outgoing business requests

Relating may request work from neighbors by emitting business messages. It must not execute their responsibilities directly.

```text
RequestVendorLinking
RequestMessageDraft
RequestOrderReview
RequestPaymentRiskReview
RequestShipmentIssueReview
RequestAccessDecision
RequestProjectFollowUp
```

## Non-CRUD rule

Relating events and messages should use business vocabulary:

```text
LeadQualified
LeadConverted
OpportunityOpened
OpportunityStageChanged
RelationshipSignalIngested
NextBestActionRaised
AiSuggestionReviewed
```

Do not introduce generic CRUD vocabulary:

```text
Created
Updated
Deleted
Saved
Removed
Index
Read
```
