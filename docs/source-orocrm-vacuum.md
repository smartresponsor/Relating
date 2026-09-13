# OroCRM Vacuum Notes

## Purpose

OroCRM is used as a Symfony-near CRM/business reference only. Relating does not import Oro bundles, controllers, routes, grids, workflows, or database layout. Every useful object is translated into the SmartResponsor Symfony canon.

## What Oro contributes

Oro's back-office sales model exposes a useful chain:

```text
lead -> qualification -> opportunity -> opportunity workflow -> forecast/dashboard/reporting
```

The Oro documentation describes leads as commercial activity with people or businesses that have authority, budget, and interest, while the probability of actual sales is not yet high or not yet definable. This maps cleanly to `Lead` as a Relating-owned object, not to `Vendor`.

Oro opportunities can be managed through workflows, viewed on a Kanban board, and inspected in the context of previous customer deals. This maps to `Opportunity`, `PipelineStage`, `OpportunityStageHistory`, `OpportunityBoardView`, `OpportunityForecastView`, and `RelationshipTimelineView`.

Oro account/contact/customer objects are not copied. They map to `VendorReference` and related neighboring ownership in `Vendoring`.

## Canonical mapping

| Oro source surface | Relating canonical target | Owner |
|---|---|---|
| Lead | Lead | Relating |
| Lead qualification | LeadQualification / LeadQualified | Relating |
| Opportunity | Opportunity | Relating |
| Opportunity workflow | Pipeline / PipelineStage / OpportunityStageTransitionInterface | Relating |
| Opportunity Kanban | OpportunityBoardView / OpportunityKanbanCardView | Relating |
| Opportunity customer history | RelationshipTimelineView | Relating |
| Account | VendorReference | Vendoring |
| Contact | VendorReference / RelationshipParticipant | Vendoring + Relating |
| Merge accounts | DuplicateCandidate / MergeProposal signal only | Relating + Vendoring |
| RFQ / Quote | QuoteIntent / QuoteLineIntent | Relating reference surface |
| Order | OrderReference | Ordering |
| Invoice / payment terms | PaymentReference | Payment |
| Products | ProductReference | Producting / Production |
| Shipping method on quote | ShipmentReference | Shipment |
| Tasks / calls / emails / calendar events | Activity / TimelineRecord / MessageThreadReference | Relating + Messaging |
| Reports, dashboards, forecast widgets | DashboardDefinition / Forecast views | Relating |
| Entity fields | ObjectDefinition / FieldDefinition | Relating metadata |
| Roles, permissions, field permissions | AccessSubjectReference | Accessing |

## Business surfaces to preserve

```text
lead qualification
opportunity stage transition
opportunity risk review
customer history review
forecast refresh
quote intent initiation
activity capture
relationship timeline projection
campaign influence review
```

## Rejected surfaces

```text
CRUD grids
CRUD account controllers
CRUD lead controllers
CRUD opportunity controllers
CRUD YAML declarations
Oro workflow engine copy
Oro entity field subsystem copy
Oro customer/account/contact master-data ownership
```

## Relating implementation note

All Oro-inspired operations must be business commands or services. CRUD responsibilities remain outside Relating.
