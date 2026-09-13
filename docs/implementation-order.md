# Relating Implementation Order

## Phase 1: EntityFirst foundation

Create and wire the core aggregate objects:

- Relationship
- Lead
- Pipeline
- PipelineStage
- Opportunity
- Activity
- ActivityTarget
- Task
- Note
- TimelineRecord

## Phase 2: ViewObjects

Build non-Doctrine API/UI response objects:

- RelationshipSummaryView
- LeadListView
- LeadDetailView
- OpportunityKanbanCardView
- RelationshipTimelineView
- RelatingDashboardView

## Phase 3: Lead conversion

Implement:

```text
Lead -> VendorReference -> Relationship -> Opportunity
```

## Phase 4: Metadata and layouts

Implement:

- ObjectDefinition
- FieldDefinition
- ViewDefinition
- LayoutDefinition

## Phase 5: Automation and AI

Implement event-driven behavior using Symfony Messenger and audited AI suggestions.


## Route boundary first

Before adding any controller or route, verify that the endpoint is a business route, not CRUD. CRUD endpoints are not part of the Relating implementation order and must remain owned by the existing CRUD mechanism.

Business-route implementation order:

1. object catalog read model;
2. lead qualification;
3. lead conversion;
4. opportunity stage transition;
5. relationship timeline build;
6. duplicate review;
7. automation run;
8. AI suggestion review.
