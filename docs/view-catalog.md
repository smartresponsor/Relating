# Relating View Catalog

Relating does not expose Doctrine entities directly to UI/API.

## Primary views

- RelationshipSummaryView
- RelationshipDetailView
- RelationshipTimelineView
- LeadListView
- LeadDetailView
- LeadKanbanCardView
- LeadConversionView
- OpportunityListView
- OpportunityDetailView
- OpportunityKanbanCardView
- OpportunityForecastView
- ActivityTimelineView
- TaskBoardView
- CampaignPerformanceView
- TargetListView
- CaseQueueView
- CaseDetailView
- QuoteIntentView
- DuplicateCandidateView
- AiSuggestionReviewView
- RelatingDashboardView
- ObjectSchemaView
- LayoutSchemaView

## View kinds

- table
- detail
- kanban
- calendar
- timeline
- dashboard
- compact
- search
- bulk_review
- import_mapping
- duplicate_review
- ai_review

## S16 naming cleanup

`mass_update` was intentionally replaced by `bulk_review` because Relating does not publish CRUD-style bulk mutation surfaces. Bulk screens must remain review/business-action surfaces.
