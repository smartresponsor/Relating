# View builder roadmap

## V1 skeleton

- `RelatingViewInterface`
- `AbstractArrayView`
- `RelatingViewSurface`
- `RelatingViewBuilderInterface`
- `RelatingViewPayloadNormalizerInterface`
- `RelatingViewSurfaceRegistryInterface`

## Implementation order

1. Build `RelationshipProfileView` from `Relationship` + `VendorReference` + score snapshots.
2. Build `RelationshipTimelineView` from `TimelineEvent` projections.
3. Build `LeadKanbanCardView` and `LeadConversionView` from Lead lifecycle use cases.
4. Build `OpportunityBoardView` from Pipeline and PipelineStage semantics.
5. Build `CampaignPerformanceView` from attribution records.
6. Build `CaseQueueView` from SLA deadlines and escalation state.
7. Build `AiSuggestionReviewView` from AI suggestion decision log.

## Boundary

View builders must not become repositories. They may compose repository results and business projections, but persistence remains behind repository/application-service boundaries.
