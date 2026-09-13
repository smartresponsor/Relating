# Relating Source Object Matrix

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This matrix maps open-source CRM terminology into the SmartResponsor Relating canon.

## Canonical ownership rule

Relating does not own every object mentioned by CRM products. It owns relationship lifecycle objects only. Neighbor components own their own master data.

```text
Vendoring  owns vendors, people, organizations, counterparties.
Producting owns products and product catalog behavior.
Ordering   owns orders and order lifecycle.
Payment    owns payment and financial settlement lifecycle.
Shipment   owns shipment and delivery lifecycle.
Messaging  owns message transport and message threads.
Accessing  owns security, permission, subjects, roles, policies.
Managing   owns backoffice management surfaces.
Relating   owns relationship lifecycle, lead, opportunity, activity, timeline, campaign, case, automation, AI review.
```

## Source-to-canon mapping

| Source term | Source family | SmartResponsor canonical target | Owner | Notes |
|---|---|---|---|---|
| People | Twenty | VendorReference / Relationship participant | Vendoring + Relating | People become vendor/person references; Relating stores lifecycle context only. |
| Companies | Twenty | VendorReference / Relationship organization | Vendoring + Relating | Company data belongs to Vendoring; Relating attaches relationship state. |
| Opportunities | Twenty / SuiteCRM / EspoCRM / OroCRM | Opportunity | Relating | Core commercial possibility object. |
| Notes | Twenty / SuiteCRM | Note / TimelineRecord | Relating | Notes are contextual relationship records unless they become documents. |
| Tasks | Twenty / SuiteCRM / EspoCRM | Task / Activity | Relating | CRM tasks are activity items with due dates, status, owner. |
| Custom Objects | Twenty | RelatingObjectDefinition | Relating | Metadata registry; no foreign dynamic ORM imported. |
| Custom Fields | Twenty / EspoCRM / Krayin | RelatingFieldDefinition | Relating | EntityFirst-compatible metadata; does not bypass typed entity model. |
| Relation Fields | Twenty | RelatingRelationshipDefinition | Relating | Metadata-level relation definitions; physical ownership follows component boundary. |
| Entity Manager | EspoCRM | RelatingObjectDefinition + RelatingFieldDefinition + RelatingRelationshipDefinition | Relating | Converted to Symfony metadata layer. |
| Layout Manager | EspoCRM | RelatingLayoutDefinition + ViewObjects | Relating | List/detail/edit/search/mass-update layout concepts become view contracts. |
| Accounts | SuiteCRM / OroCRM | VendorReference | Vendoring | Not recreated inside Relating. |
| Contacts | SuiteCRM / OroCRM | VendorReference | Vendoring | Not recreated inside Relating. |
| Leads | SuiteCRM / EspoCRM / Krayin | Lead | Relating | Raw prospect or unresolved business interest. |
| Lead Source | SuiteCRM / Krayin | LeadSource / Source | Relating | Captures origin and attribution. |
| Calls | SuiteCRM / EspoCRM | Call / Activity | Relating | Timeline activity specialization. |
| Meetings | SuiteCRM / EspoCRM | Meeting / Activity | Relating | Timeline activity specialization. |
| Emails | SuiteCRM | MessageThreadReference / TimelineRecord | Messaging + Relating | Transport belongs to Messaging; CRM timeline references the thread. |
| Campaigns | SuiteCRM / OroCRM / CiviCRM | Campaign | Relating | Marketing or nurture relationship program. |
| Targets | SuiteCRM | TargetListMember / CampaignMember | Relating | Prefer target list/member model. |
| Target Lists | SuiteCRM | TargetList | Relating | Campaign audience object. |
| Cases | SuiteCRM / CiviCRM | CaseRecord | Relating | Relationship issue/escalation; not full helpdesk yet. |
| Bugs | SuiteCRM | CaseRecord or ProjectReference | Relating + Projecting | Only if bug is customer-facing relationship issue. |
| Projects | SuiteCRM / Twenty custom | ProjectReference | Projecting | Relating references only. |
| Documents | SuiteCRM / CiviCRM | DocumentReference | Documentating/Media | Not owned by Relating. |
| Quotes | SuiteCRM / Krayin | QuoteIntent | Relating + Ordering | Relating stores commercial intent; order/quote engine owns finalized commerce. |
| Invoices | SuiteCRM AOS | PaymentReference / OrderReference | Payment + Ordering | Not owned by Relating. |
| Contracts | SuiteCRM AOS | CommercialTerm / DocumentReference | Relating + Documentating | Only relationship intent/term metadata here. |
| Products | SuiteCRM / Krayin / OroCRM | ProductReference / OpportunityProductInterest | Producting + Relating | Relating stores interest, not product master data. |
| Product views | OroCRM | TimelineRecord / ProductInterestSignal | Relating + Producting | Useful for relationship 360. |
| Support tickets | OroCRM | CaseRecord / CaseThread | Relating | Relationship issue view. |
| Contributions | CiviCRM | PaymentReference / ContributionSignal | Payment + Relating | Nonprofit signal only; financial ownership elsewhere. |
| Memberships | CiviCRM | Relationship segment / MembershipReference | Relating or Membership component later | Keep as signal until separate component exists. |
| Events | CiviCRM | CampaignTouch / EventParticipationSignal | Relating | Use as engagement signal, not event-management module. |
| Mailings | CiviCRM | CampaignTouch / MessageThreadReference | Relating + Messaging | Campaign touch references Messaging. |
| Reports | SuiteCRM / CiviCRM / OroCRM | DashboardView / ReadModel | Relating + Viewing | Business read models only; avoid SQL-first report ownership. |
| Workflow | SuiteCRM / Twenty / Krayin | AutomationRule / AutomationRun | Relating | Business workflow through Symfony Messenger and audit. |

## Required Relating additions from matrix

The current skeleton should keep or add these canonical objects:

```text
Relationship
RelationshipParticipant
RelationshipSignal
Lead
LeadSource
LeadQualification
LeadConversion
Opportunity
OpportunityStageHistory
OpportunityProductInterest
Activity
Call
Meeting
Task
Note
TimelineRecord
Campaign
CampaignMember
TargetList
TargetListMember
CampaignTouch
CampaignResponse
CaseRecord
CaseThread
QuoteIntent
CommercialTerm
RelatingObjectDefinition
RelatingFieldDefinition
RelatingRelationshipDefinition
RelatingLayoutDefinition
RelatingViewDefinition
AutomationRule
AutomationRun
AiSuggestion
AiDecisionLog
DuplicateCandidate
MergeProposal
```

## Naming direction

Avoid source-specific names unless they are industry standard. Prefer Relating names:

```text
Customer360View     -> RelationshipProfileView
AccountGraph        -> VendorRelationshipGraphView
DealBoard           -> OpportunityBoardView
ContactActivity     -> RelationshipTimelineView
CampaignRecipients  -> CampaignMemberView
CaseQueue           -> CaseQueueView
```


## Wave D2 additions

| Source term | Source family | SmartResponsor canonical target | Owner | Notes |
|---|---|---|---|---|
| Relation to multiple object types | Twenty | TimelineTarget / RelationshipSignal | Relating | Typed target tuple, not unbounded ORM polymorphism. |
| AI Agents | Twenty | AiSuggestion / AiDecisionLog | Relating | Agents produce suggestions and reviewable outputs only. |
| Record created workflow trigger | Twenty | AutomationTrigger | Relating | Business trigger only; no CRUD route generation. |
| Bottom Panels | EspoCRM | RelationshipRelatedPanelView | Relating | Related objects read model. |
| Side Panels | EspoCRM | RelationshipSidePanelView | Relating | Context read model. |
| Dynamic Logic | EspoCRM | LayoutCondition / FieldVisibilityRule | Relating | Future metadata; enforce via ViewObject compiler. |
| Case conversation thread | SuiteCRM | CaseThread / TimelineRecord | Relating | Relationship issue history. |
| Campaign real-time response tracking | SuiteCRM | CampaignResponse / RelationshipSignal | Relating | Response becomes signal for lead/relationship. |
| Customer 360 interaction data | OroCRM | RelationshipProfileView / RelationshipSignal | Relating | Cross-component relationship profile. |
| Account merge | OroCRM | MergeProposal | Relating + Vendoring | Relating proposes; Vendoring owns final merge. |

## D3 additions: OroCRM / Krayin / CiviCRM

| Source | Source object/surface | Canonical Relating mapping | Neighbor owner |
|---|---|---|---|
| OroCRM | Lead | Lead | Relating |
| OroCRM | Qualify Lead | LeadQualification / LeadQualified | Relating |
| OroCRM | Opportunity Workflow | Pipeline / PipelineStage / OpportunityStageTransitionInterface | Relating |
| OroCRM | Opportunity Kanban | OpportunityBoardView / OpportunityKanbanCardView | Relating |
| OroCRM | Account | VendorReference | Vendoring |
| OroCRM | Contact | VendorReference / RelationshipParticipant | Vendoring + Relating |
| OroCRM | RFQ / Quote | QuoteIntent / QuoteLineIntent | Relating reference surface |
| OroCRM | Forecast dashboard widgets | OpportunityForecastView / RelatingDashboardView | Relating |
| Krayin | Lead pipeline | Lead / Pipeline / PipelineStage | Relating |
| Krayin | Activities | Activity / Call / Meeting / Note | Relating |
| Krayin | Persons | VendorReference / RelationshipParticipant | Vendoring + Relating |
| Krayin | Organizations | VendorReference | Vendoring |
| Krayin | Products | ProductReference | Producting / Production |
| Krayin | Quotes | QuoteIntent / QuoteLineIntent | Relating reference surface |
| Krayin | Custom attributes | ObjectDefinition / FieldDefinition / FieldOption | Relating metadata |
| Krayin | Attribute groups | LayoutDefinition / LayoutSchemaView | Relating metadata |
| Krayin | Quick Add | business capture route only | Relating |
| CiviCRM | Contact | VendorReference | Vendoring |
| CiviCRM | Relationships | RelationshipRelation / RelationshipParticipant | Relating |
| CiviCRM | Activities | Activity / TimelineRecord | Relating |
| CiviCRM | Contributions | ContributionReference / RelationshipSignal | Payment/external + Relating signal |
| CiviCRM | Memberships | MembershipReference / RelationshipSignal | External + Relating signal |
| CiviCRM | Events | EventReference / RelationshipSignal | External + Relating signal |
| CiviCRM | Search displays | ViewDefinition / ViewFilter / ViewColumn | Relating metadata |
| CiviCRM | Deduping and merging | DuplicateCandidate / MergeProposal | Relating + Vendoring |

