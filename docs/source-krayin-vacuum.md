# Krayin Vacuum Notes

## Purpose

Krayin is used as a lightweight PHP CRM reference for SMB-friendly forms, pipeline behavior, custom attributes, quote intent, and quick-add UX. Relating does not import Laravel package structure, controllers, routes, migrations, or ACL mechanics.

## What Krayin contributes

Krayin's useful reference shape is practical rather than enterprise-heavy:

```text
lead pipeline
activities
persons and organizations
products and quotes
email inside CRM
custom fields
ACL
modular feature packages
```

The important lesson for Relating is not Laravel modularity. It is the compact CRM object set and the attribute-driven UX: fields can be attached to entity types such as Leads, Person, Organization, Products, Quotes, and Warehouses, and attributes can be marked for quick-add forms.

## Canonical mapping

| Krayin source surface | Relating canonical target | Owner |
|---|---|---|
| CRM dashboard | RelatingDashboardView | Relating |
| Lead pipeline | Lead / Pipeline / PipelineStage | Relating |
| Lead stage tracking | LeadStatus / PipelineStage | Relating |
| Kanban visualization | LeadKanbanCardView / OpportunityBoardView | Relating |
| Activities: calls, meetings, notes | Activity / Call / Meeting / Note | Relating |
| Persons | VendorReference / RelationshipParticipant | Vendoring + Relating |
| Organizations | VendorReference | Vendoring |
| Relationship history | RelationshipTimelineView | Relating |
| Products | ProductReference | Producting / Production |
| Quotes | QuoteIntent / QuoteLineIntent | Relating reference surface |
| Email inbox | MessageThreadReference / ActivityTarget | Messaging + Relating |
| Custom fields / attributes | ObjectDefinition / FieldDefinition / FieldOption | Relating metadata |
| Attribute groups | LayoutDefinition / LayoutSchemaView | Relating view metadata |
| Quick Add | Business quick-capture command, not CRUD route | Relating |
| ACL | AccessSubjectReference | Accessing |

## Field type normalization

Krayin field types are translated into Relating `FieldType` values:

```text
text
textarea
money
boolean
date
datetime
email
phone
select
multiselect
lookup
image_reference
file_reference
address_reference
subheading
```

`subheading` is explicitly layout-only. It must not create persistence fields.

## Quick Add rule

Quick Add is a business capture surface. It is not a generic create route. In Relating it should become a short business workflow such as:

```text
capture lead from board
capture activity from timeline
capture note from relationship
capture quote intent from opportunity
```

No `create` CRUD action is generated.
