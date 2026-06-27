# Source Coverage Report

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This report records what has already been vacuumed from CRM references and what remains for later waves.

## Covered source families

| Source | Coverage status | Extracted value | Next action |
|---|---:|---|---|
| Twenty | D1 complete, refine later | Object/field/record model, custom objects, views, pipelines, workflow/AI orientation | Add detailed workflow trigger/action map |
| EspoCRM | D2 complete, refine later | Entity Manager, fields, relationships, layout surfaces | Add exact field type matrix and dynamic logic policy |
| SuiteCRM | D2 complete, refine later | Broad CRM module catalog, workflows, campaigns, cases, sales objects | Add conversion/duplicate behavior matrix |
| OroCRM | D3 complete, refine later | Lead qualification, opportunity workflow, customer 360, dashboard/forecast surfaces | Add exact workflow transition matrix |
| Krayin | D3 complete, refine later | SMB CRM UX, quick forms, attributes, activities, quote intent | Add field/attribute type matrix |
| CiviCRM | D3 complete, refine later | Relationship graph, activities, community lifecycle, contribution/member/event references | Add nonprofit/community extension profile |

## Already normalized

```text
Account/Contact/Person/Company -> VendorReference + Relationship/Participant
Lead -> Lead lifecycle
Opportunity/Deal -> Opportunity pipeline
Task/Call/Meeting/Note -> Activity/Timeline
Campaign/TargetList/Source -> Campaign/Attribution
Case/Bug/Support issue -> CaseRecord/CaseSla/CaseResolution
Quote/Product interest -> QuoteIntent/ProductReference
Report/Dashboard/View/Layout -> ViewObject/Definition layer
Workflow/Agent/Automation -> AutomationRule/AiSuggestion/AiDecisionLog
```

## Remaining documentation vacuum waves

### D4: Workflow and automation matrix

Extract trigger/action/condition patterns:

```text
record changed
stage changed
task due
campaign response captured
case escalated
score threshold crossed
duplicate detected
AI suggestion accepted
```

### D5: Permission and ownership matrix

Extract and normalize:

```text
owner
team
role
workspace
record visibility
portal/customer access
assigned user
watcher/follower
Accessing boundary
```

### D6: Import, duplicate, merge, and data quality matrix

Extract and normalize:

```text
import mapping
duplicate detection
merge proposal
merge approval
source confidence
field provenance
```

### D7: Reporting, dashboard, and forecasting matrix

Extract and normalize:

```text
pipeline forecast
activity dashboard
campaign performance
case SLA dashboard
relationship health
AI risk review
```

### D8: AI-native Relating profile

Define SmartResponsor-specific leadership surfaces:

```text
next best action
relationship health explanation
opportunity risk explanation
lead fit scoring
campaign response classification
duplicate confidence explanation
case triage summary
AI decision log
```

## Current conclusion

The skeleton is now ready for `A` waves: architecture normalization and implementation planning.

The next implementation-safe steps are:

```text
A1 canonical object matrix
A2 boundary ADR
A3 implementation milestone map
A4 ViewObject API contract
A5 event/message catalog
```
