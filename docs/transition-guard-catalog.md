# Transition Guard Catalog

Transition guards protect lifecycle movement.

## Guarded transitions

```text
Lead: captured -> qualified -> converted
Lead: captured -> disqualified
Opportunity: discovery -> proposal -> negotiation -> commit -> closed_won
Opportunity: discovery -> closed_lost
CaseRecord: opened -> escalated -> resolved
AiSuggestion: raised -> reviewed -> applied/rejected
```

## Guard outcomes

```text
pass
block
review
```

A review outcome is intentionally first-class. CRM/Relating actions often need human confirmation, especially where AI suggestions, neighbor signals, score changes, or opportunity closure are involved.

## Boundary

Transition guards are not Doctrine lifecycle callbacks and are not CRUD event listeners. They belong to explicit application services and message handlers.
