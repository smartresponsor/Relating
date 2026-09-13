# SuiteCRM Module Vacuum Notes

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

## Purpose

SuiteCRM is used as a broad legacy CRM object checklist. Its value is the width of mature CRM modules, not its implementation style.

Relating does not copy SuiteCRM module architecture, controllers, SQL patterns, route names, CRUD actions, or legacy naming where it conflicts with SmartResponsor canon.

## Core module normalization

| SuiteCRM module | Relating canonical target | Owner | Rule |
|---|---|---|---|
| Accounts | VendorReference / Relationship | Vendoring + Relating | No Account entity in Relating. |
| Contacts | VendorReference / RelationshipParticipant | Vendoring + Relating | No Contact master data in Relating. |
| Opportunities | Opportunity | Relating | Keep. |
| Leads | Lead | Relating | Keep. |
| Calendar | ActivityCalendarView | Relating/Viewing | View surface only. |
| Calls | Call / Activity | Relating | Timeline specialization. |
| Meetings | Meeting / Activity | Relating | Timeline specialization. |
| Email Templates | MessageTemplateReference | Messaging | Reference only. |
| Emails | MessageThreadReference / TimelineRecord | Messaging + Relating | Transport is Messaging. |
| Tasks | Task / Activity | Relating | Keep. |
| Notes | Note / TimelineRecord | Relating | Keep. |
| Documents | DocumentReference | Documentating/Media | Reference only. |
| Targets | TargetListMember / CampaignMember | Relating | Normalize. |
| Target Lists | TargetList | Relating | Keep. |
| Campaigns | Campaign | Relating | Keep. |
| Surveys | CampaignResponse / FormResponseSignal | Relating + Forming later | Signal only. |
| Bugs | CaseRecord or ProjectReference | Relating + Projecting | Only customer-facing issue. |
| Cases | CaseRecord | Relating | Keep as support/escalation relationship object. |
| Projects | ProjectReference | Projecting | Reference only. |
| Employees | UserReference | Accessing/Managing | Reference only. |
| Reports | DashboardView / ReadModel | Viewing + Relating | No SQL-first reports. |
| Workflow | AutomationRule | Relating | Business automations only. |

## Advanced sales normalization

| SuiteCRM AOS module | Relating target | Owner rule |
|---|---|---|
| Product Categories | ProductReference | Producting owns. |
| Products | ProductReference / OpportunityProductInterest | Producting owns; Relating stores interest. |
| PDF Templates | DocumentTemplateReference | Documentating owns. |
| Quotations | QuoteIntent | Relating stores pre-order commercial intent only. |
| Invoices | OrderReference / PaymentReference | Ordering/Payment own. |
| Contracts | CommercialTerm / DocumentReference | Relating stores relationship term metadata only. |

## Business chains preserved from SuiteCRM

```text
lead_capture -> lead_qualification -> lead_conversion -> opportunity_opened
campaign_targeting -> campaign_touch -> campaign_response -> lead_or_relationship_signal
case_opened -> case_assigned -> case_escalated -> case_resolved -> relationship_timeline_update
opportunity_pipeline -> quote_intent -> order_reference -> payment_reference
workflow_condition -> business_action -> automation_run -> audit
```

## Rejected SuiteCRM concepts

```text
No module-per-CRUD-controller import.
No Accounts/Contacts duplication.
No SQL-first reporting as core Relating design.
No generic workflow mutating any module without explicit service/event contract.
No AOS invoice/product ownership inside Relating.
```

## Source anchors

```text
https://docs.suitecrm.com/
https://docs.suitecrm.com/user/core-modules/
https://docs.suitecrm.com/user/core-modules/campaigns/
https://docs.suitecrm.com/user/core-modules/cases/
https://docs.suitecrm.com/user/advanced-modules/workflow/
https://docs.suitecrm.com/user/advanced-modules/sales/
```
