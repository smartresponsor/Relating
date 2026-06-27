# Business Policy Catalog

Policies decide whether a business lifecycle action may continue.

## Policies

| Policy | Business action | Decision |
|---|---|---|
| RelationshipStartPolicyInterface | relationship.start | allow, deny, needs review |
| LeadQualificationPolicyInterface | lead.qualify | allow, deny, needs review |
| LeadConversionPolicyInterface | lead.convert | allow, deny, needs review |
| OpportunityStageTransitionPolicyInterface | opportunity.stage_transition | pass, block, review |
| AiSuggestionReviewPolicyInterface | ai_suggestion.review | allow, deny, needs review |
| NeighborSignalPolicyInterface | neighbor_signal.ingest | allow, deny, needs review |
| RelatingReferencePolicyInterface | reference.use | allow, deny, needs review |

## Non-goals

Policies must not become CRUD permissions.

Accessing remains the owner of access rules. Relating may ask policy questions and hold decision traces, but it must not own users, roles, permissions, grants, or access matrices.
