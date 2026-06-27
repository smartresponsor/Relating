# AI Suggestion Lifecycle

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

Relating may use AI for scoring, summarization, next-best-action, duplicate review, case triage, forecast risk, and campaign response classification.

AI must not become an uncontrolled writer.

## Canonical lifecycle

```text
AiSignalRecorded
-> AiSuggestionRaised
-> AiSuggestionReviewed
-> AiSuggestionAccepted | AiSuggestionRejected
-> AiSuggestionApplied
-> AiDecisionLogged
```

## Suggestion statuses

```text
pending
accepted
rejected
applied
expired
rolled_back
```

## AI action policy

```text
AI can read approved ViewObjects.
AI can generate suggestions.
AI can draft messages or next actions.
AI cannot directly create CRUD routes.
AI cannot directly mutate Vendor, Order, Payment, Shipment, Access, Message, Product, or Project.
AI application must be audited.
```

## Safe Relating AI surfaces

```text
Lead score explanation
Lead duplicate suggestion
Opportunity risk explanation
Next best action
Relationship summary
Campaign response classification
Case triage suggestion
Timeline summary
```

## Unsafe surfaces

```text
Direct account mutation
Direct payment mutation
Direct access change
Unreviewed external message sending
Unreviewed order/shipment state change
Prompt-driven arbitrary automation action
```
