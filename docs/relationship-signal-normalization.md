# Relationship Signal Normalization

A neighbor signal becomes useful to Relating only after normalization.

## Normalized envelope

```text
NeighborSignalEnvelope
- sourceComponent
- signalKind
- sourceReference
- relationshipReference
- payload
```

## Signal weighting

Relationship scoring should treat signals as typed evidence, not as direct truth. Examples:

```text
message.received        +5 engagement
message.unanswered      -8 engagement
order.placed           +12 commercial value
payment.failed         -20 health
shipment.delayed       -10 health
case.escalated         -25 health
project.milestone      +8 trust
```

The exact weights belong to scoring policy configuration, not to entity constructors.

## AI boundary

AI may classify, summarize, and suggest actions from signals, but must not directly mutate neighboring components. AI output enters Relating as `AiSuggestionRaised`, then waits for review or a guarded automation decision.
