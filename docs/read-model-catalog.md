# Read Model Catalog

| Read model | Target | Purpose | Owner |
| --- | --- | --- | --- |
| RelationshipTimelineReadModel | Relationship reference | Ordered business history projection | Relating |
| OpportunityForecastReadModel | Opportunity reference | Pipeline forecast category and expected value | Relating |
| OpportunityRiskReadModel | Opportunity reference | Risk score, risk level, risk reasons, next action | Relating |
| CampaignPerformanceReadModel | Campaign reference | Members, touches, responses, influenced value | Relating |
| CaseSlaReadModel | Case reference | SLA status, deadline, breach and escalation state | Relating |
| RelationshipHealthReadModel | Relationship reference | Health, engagement, lifecycle, next action signal | Relating |

Neighbor records are referenced through scalar references only. Vendoring, Producting, Ordering, Payment, Shipment, Messaging, Projecting, Accessing, Assessing, Managing, Documentating, Media, and Viewing keep their own ownership.
