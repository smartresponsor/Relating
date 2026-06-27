# Relating view surface catalog

This catalog maps CRM/open-source UI ideas into SmartResponsor business surfaces without recreating CRUD screens.

| Surface | Purpose | Inspired by | CRUD? |
|---|---|---|---|
| `relationship.profile` | Vendor-centered CRM profile | OroCRM customer 360, CiviCRM relationship record | No |
| `relationship.timeline` | Business history across neighbors | SuiteCRM activities, CiviCRM activities | No |
| `relationship.graph` | Relationship/participant graph | CiviCRM relationships, Oro account graph | No |
| `lead.kanban` | Qualification board | Twenty/Espo/Krayin kanban | No |
| `lead.conversion` | Lead to Vendor/Opportunity conversion review | SuiteCRM/Espo lead conversion | No |
| `opportunity.board` | Pipeline board | Twenty/Espo/Oro pipeline | No |
| `opportunity.forecast` | Forecast categories and weighted value | Espo/Oro forecast | No |
| `activity.timeline` | Calls, meetings, notes, tasks, message references | SuiteCRM/Espo activity panels | No |
| `campaign.performance` | Touches, responses, attribution | SuiteCRM campaigns, Oro campaign stats | No |
| `case.queue` | SLA and escalation queue | SuiteCRM cases, CiviCase | No |
| `ai.suggestion_review` | AI suggestion acceptance/rejection | Twenty AI actions, CRMArena risk pattern | No |
| `dashboard` | Relationship lifecycle overview | CRM dashboards | No |

Every surface is a business view. None is an entity CRUD list/detail route.
