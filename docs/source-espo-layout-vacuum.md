# EspoCRM Entity and Layout Vacuum Notes

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

## Purpose

EspoCRM is used as a reference for metadata-driven CRM customization: entity types, fields, relationships, layouts, dynamic logic, roles, email/portal surfaces, and API boundaries.

Relating does not copy EspoCRM PHP structure, storage model, controllers, SQL, routes, or CRUD behavior.

## Useful source concepts

```text
Entity Manager      -> ObjectDefinition / FieldDefinition / RelationshipDefinition
Relationships       -> RelationshipDefinition + TimelineTarget + Reference value objects
Layout Manager      -> LayoutDefinition + ViewDefinition + ViewObject classes
Dynamic Logic       -> View condition and business rule metadata
Roles               -> Accessing reference only
Email               -> Messaging reference only
Portal              -> UI/Accessing integration later
Formula/BeforeSave  -> Explicit Symfony service or Messenger event only
```

## Layout surfaces to preserve as canonical views

| Espo-style surface | Relating canonical view/design | Rule |
|---|---|---|
| List layout | LeadListView / OpportunityListView / CaseQueueView | Read model only. |
| Detail layout | RelationshipDetailView / LeadDetailView / OpportunityDetailView | ViewObject only. |
| Edit layout | Form schema later; not CRUD route. | No create/update action route. |
| Search filters | ViewFilter / FilterExpression | Query criteria, not direct SQL. |
| Mass update layout | Business batch command only when needed. | No generic CRUD mass update route. |
| Side panels | RelationshipSidePanelView | Context summary. |
| Bottom panels | RelationshipRelatedPanelView | Related activity/signals. |
| Kanban | OpportunityBoardView / LeadKanbanCardView | Business board surface. |
| Relationship panel | RelationshipGraphView | Relationship edges/signals. |

## Relationship type normalization

Espo link types become explicit, typed Relating relationships:

```text
belongsTo        -> reference owned by current object
hasMany          -> related panel/read model
hasOne           -> optional reference/snapshot
belongsToParent  -> TimelineTarget / polymorphic target
hasChildren      -> child timeline/activity objects
```

No unbounded generic table should own foreign component state.

## Relating additions from EspoCRM

```text
LayoutDefinition
ViewDefinition
ViewFilter
ViewSort
ViewColumn
RelationshipRelatedPanelView
RelationshipSidePanelView
RelationshipGraphView
FieldVisibilityRule
LayoutCondition
```

## Rejected EspoCRM concepts

```text
No generic before-save script that changes entities invisibly.
No layout definition that produces CRUD routes.
No field metadata that skips Symfony Validator/EntityFirst invariants.
No internal access model duplication; Accessing owns permissions.
```

## Source anchors

```text
https://docs.espocrm.com/administration/entity-manager/
https://docs.espocrm.com/administration/layout-manager/
https://docs.espocrm.com/administration/terms-and-naming/
https://docs.espocrm.com/
```
