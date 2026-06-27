# Twenty Vacuum Notes for Relating

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

## Purpose

Twenty is used as a modern CRM reference only. Relating does not copy TypeScript, NestJS, GraphQL, table design, route names, controller design, or CRUD behavior.

## Useful source concepts

Twenty describes its CRM building blocks as objects, views, workflows, and agents. In Relating, this becomes a Symfony-first metadata and business automation layer.

```text
Twenty object        -> App\Entity\ObjectDefinition
Twenty field         -> App\Entity\FieldDefinition
Twenty relation      -> App\Entity\RelationshipDefinition
Twenty saved view    -> App\Entity\ViewDefinition + App\View\*
Twenty workflow      -> App\Entity\AutomationRule / AutomationRun
Twenty AI agent      -> App\Entity\AiSuggestion / AiDecisionLog
```

## Standard object normalization

| Twenty object/surface | Relating canonical model | Owner | Rule |
|---|---|---|---|
| People | VendorReference + RelationshipParticipant | Vendoring + Relating | Do not create Person master data in Relating. |
| Companies | VendorReference + Relationship | Vendoring + Relating | Do not create Company master data in Relating. |
| Opportunities | Opportunity | Relating | Core commercial opportunity object. |
| Notes | Note + TimelineEvent | Relating | Notes can attach to relationship lifecycle targets. |
| Tasks | Task + Activity | Relating | Tasks are CRM activity items. |
| Custom objects | ObjectDefinition | Relating | Metadata registry only; do not bypass EntityFirst model. |
| Custom fields | FieldDefinition | Relating | Field metadata must compile into typed views/forms. |
| Custom views | ViewDefinition | Relating | Saved view state; not a CRUD route generator. |
| Workflows | AutomationRule | Relating | Business automations only. |
| Agents | AiSuggestion / AiDecisionLog | Relating | AI suggests; it does not silently mutate state. |

## Polymorphic relation lesson

Twenty relation fields allow objects such as notes to connect to multiple object types. Relating should support this as a typed target value, not as unbounded ORM polymorphism.

```text
TimelineTarget
- targetComponent
- targetType
- targetReference
```

Allowed target families:

```text
relationship
lead
opportunity
activity
campaign
case_record
quote_intent
vendor_reference
product_reference
order_reference
payment_reference
shipment_reference
message_thread_reference
project_reference
```

## Relating additions from Twenty

```text
RelationshipParticipant
RelationshipSignal
RelationshipGraphView
RelationshipProfileView
ObjectDefinitionCompiler
ViewDefinitionCompiler
AutomationRuleRunner
AiSuggestionReviewService
```

## Rejected Twenty concepts

```text
No TypeScript backend transplant.
No GraphQL-first API requirement.
No object metadata that bypasses Doctrine entity ownership.
No generated CRUD routes from saved views.
No AI action that writes without AiDecisionLog.
```

## Source anchors

```text
https://github.com/twentyhq/twenty
https://docs.twenty.com/user-guide/data-model/overview
https://docs.twenty.com/user-guide/views-pipelines/overview
https://docs.twenty.com/user-guide/workflows/capabilities/workflow-triggers
https://docs.twenty.com/user-guide/workflows/capabilities/workflow-actions
https://docs.twenty.com/user-guide/data-model/capabilities/relation-fields
```
