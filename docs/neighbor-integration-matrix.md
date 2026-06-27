# Neighbor Integration Matrix

| Relating use case | Neighbor inputs | Relating output | Business route candidate |
|---|---|---|---|
| Start relationship | VendorReference, owner reference | RelationshipStarted | `/relating/relationship/start` |
| Capture lead | Source, campaign, contact point snapshot | LeadCaptured | `/relating/lead/capture` |
| Qualify lead | score, source, activity summary | LeadQualified / LeadRejected | `/relating/lead/qualify` |
| Convert lead | VendorReference, optional Opportunity | LeadConverted | `/relating/lead/convert` |
| Open opportunity | Relationship, product interest, campaign source | OpportunityOpened | `/relating/opportunity/open` |
| Change stage | PipelineStage, reason, actor | OpportunityStageChanged | `/relating/opportunity/transition` |
| Record activity | MessageThreadReference, owner, participants | ActivityRecorded | `/relating/activity/record` |
| Project timeline | signals + activities | TimelineEventProjected | `/relating/timeline/project` |
| Score health | payment/order/shipment/message/case signals | RelationshipHealthScored | `/relating/relationship/score` |
| Review AI suggestion | suggestion + actor decision | AiSuggestionReviewed | `/relating/ai-suggestion/review` |
| Triage case | message/payment/shipment/order risk | CaseTriaged | `/relating/case/triage` |

The routes above are business routes. They are not CRUD routes and must not map to index/create/read/update/delete actions.
