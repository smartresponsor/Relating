# Decision Trace Catalog

| Trace | Purpose | Example |
|---|---|---|
| BusinessDecisionTrace | User/system lifecycle decision | lead qualification accepted |
| PolicyDecisionTrace | Business guard result | transition denied because stage is closed |
| AiReviewTrace | Human/system review of AI suggestion | accepted next best action |
| TransitionTrace | State movement | opportunity moved from qualification to proposal |
| NeighborSignalTrace | Signal from/to neighbor component | Ordering signal linked to relationship |

All traces must carry a correlation id and business subject reference.
