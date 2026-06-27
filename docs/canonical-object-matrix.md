# Canonical Relating Object Matrix

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This matrix normalizes CRM objects discovered from open-source CRM references into the SmartResponsor `Relating` canon.

The matrix is intentionally not a CRUD plan. It is an object and boundary map for EntityFirst design, ViewObject design, business routes, workflow events, and neighbor references.

## Hard rules

```text
Component: App\Relating
Root object: Relationship
Market category: CRM
Route policy: business routes only
CRUD policy: never create CRUD controllers, CRUD YAML, CRUD route attributes, or index/create/read/update/delete action routes
```

## Canonical source transformation

| Source family | Source object | SmartResponsor canonical result | Owner | Relating responsibility |
|---|---|---|---|---|
| Twenty | People | VendorReference + RelationshipParticipant | Vendoring + Relating | Keep relationship role, lifecycle, participation, engagement signal |
| Twenty | Companies | VendorReference + Relationship | Vendoring + Relating | Keep relationship profile and timeline around vendor |
| Twenty | Opportunities | Opportunity | Relating | Own pipeline, stage history, forecast, risk, product interest references |
| Twenty | Notes | Note + TimelineEvent | Relating | Own CRM note as business activity; do not own document storage |
| Twenty | Tasks | Task + Reminder + TimelineEvent | Relating | Own CRM task and next-action planning |
| Twenty | Custom Object | RelatingObjectDefinition | Relating | Own metadata definition if object is CRM-specific; otherwise reference neighbor |
| Twenty | Views | RelatingViewDefinition + ViewObject | Relating | Own saved business read-model configuration |
| Twenty | Workflows | AutomationRule | Relating | Own CRM triggers/actions; dispatch through Symfony Messenger |
| Twenty | Agents | AiSuggestion / AiDecisionLog | Relating | Suggest, review, apply with audit; never untraced mutation |
| EspoCRM | Entity Manager entity | RelatingObjectDefinition | Relating | Only for CRM-owned object definitions |
| EspoCRM | Fields | RelatingFieldDefinition | Relating | Metadata field description, not DB-migration-first design |
| EspoCRM | Relationships | RelatingRelationshipDefinition | Relating | Object relationship metadata and link policy |
| EspoCRM | List layout | List ViewObject | Relating | Read model for UI/API, no Doctrine entity leakage |
| EspoCRM | Detail/Edit layout | Detail/Edit ViewObject | Relating | View contract and form intent only, not CRUD route |
| EspoCRM | Search filters | RelatingViewFilter | Relating | Business filtering metadata |
| EspoCRM | Mass update layout | Rejected for core | N/A | Dangerous CRUD-adjacent surface; must go through explicit business action |
| SuiteCRM | Accounts | VendorReference | Vendoring | Relating may store relationship status, owner, health, lifecycle |
| SuiteCRM | Contacts | VendorReference + RelationshipParticipant | Vendoring + Relating | Relating stores role in relationship/opportunity/campaign/case |
| SuiteCRM | Leads | Lead | Relating | Own capture, qualification, scoring, duplicate review, conversion |
| SuiteCRM | Opportunities | Opportunity | Relating | Own pipeline and commercial intent |
| SuiteCRM | Calls | Call + Activity | Relating | Own activity record and timeline event |
| SuiteCRM | Meetings | Meeting + Activity | Relating | Own activity record and calendar reference |
| SuiteCRM | Tasks | Task | Relating | Own CRM next action |
| SuiteCRM | Notes | Note | Relating | Own CRM annotation and timeline projection |
| SuiteCRM | Emails | MessageThreadReference + TimelineEvent | Messaging + Relating | Do not own email transport; project relationship signal |
| SuiteCRM | Documents | DocumentReference | Documentating/Media | Do not own document storage; keep references in timeline/case/quote intent |
| SuiteCRM | Targets | TargetProfile / LeadCandidate | Relating | Own target membership and campaign readiness |
| SuiteCRM | Target Lists | TargetList | Relating | Own campaign audience list |
| SuiteCRM | Campaigns | Campaign | Relating | Own campaign lifecycle, touches, responses, attribution |
| SuiteCRM | Surveys | CampaignResponse / FeedbackSignal | Relating | Own response signal, not survey engine by default |
| SuiteCRM | Cases | CaseRecord | Relating | Own relationship issue, SLA, escalation, resolution |
| SuiteCRM | Bugs | CaseRecord subtype or ProductIssueReference | Relating + Producting | Own customer-facing issue signal; product defect stays outside |
| SuiteCRM | Projects | ProjectReference | Projecting | Relating stores relationship/case/opportunity linkage only |
| SuiteCRM | Employees | UserReference / AccessSubjectReference | Accessing/Managing | Relating only references owner/assignee |
| SuiteCRM | Quotes | QuoteIntent | Relating + Ordering | Relating owns intent, lines, terms; final order/invoice outside |
| SuiteCRM | Contracts | ContractReference / CommercialTerm | Documentating/Ordering + Relating | Own commercial intent/terms only if CRM-specific |
| SuiteCRM | Invoices | PaymentReference / OrderReference | Payment/Ordering | Never recreate invoice domain |
| SuiteCRM | Workflow | AutomationRule | Relating | Only business workflow with audit and Messenger dispatch |
| SuiteCRM | Reports | RelatingDashboardDefinition | Viewing/Relating | Read model/report config, no direct SQL-first ownership |
| OroCRM | Account/Contact hierarchy | VendorRelationshipGraph | Vendoring + Relating | Graph view around vendor references |
| OroCRM | Lead qualification | LeadQualification | Relating | Business action and event |
| OroCRM | Opportunity workflow | OpportunityStageHistory | Relating | Transition service and stage history |
| OroCRM | Forecast/dashboard | OpportunityForecast / DashboardView | Relating | Business read model |
| OroCRM | Campaign performance | CampaignPerformanceView | Relating | Source/response/attribution view |
| Krayin | Persons/Organizations | VendorReference | Vendoring | Relating stores roles and signals |
| Krayin | Activities | Activity | Relating | Practical SMB activity UX |
| Krayin | Products/Quotes | ProductReference + QuoteIntent | Producting/Ordering + Relating | Interest/intention only |
| Krayin | Custom attributes | RelatingFieldDefinition | Relating | Metadata-driven field catalog |
| CiviCRM | Contacts | VendorReference | Vendoring | Community/constituent relationship role only |
| CiviCRM | Relationships | RelationshipRelation | Relating | First-class relationship graph edges |
| CiviCRM | Activities | Activity | Relating | Unified historical interaction |
| CiviCRM | Groups | TargetList / SegmentReference | Relating | Audience grouping and segmentation |
| CiviCRM | Contributions | ContributionReference | Payment/Donation component | Reference/signal only |
| CiviCRM | Memberships | MembershipReference | Membership component | Reference/signal only |
| CiviCRM | Events | EventReference | Eventing/Projecting | Reference/signal only |

## Object classification

### Relating-owned entity objects

```text
Relationship
RelationshipRelation
RelationshipParticipant
RelationshipSignal
Lead
LeadSource
LeadType
LeadQualification
LeadScore
LeadConversion
LeadAssignment
LeadRejection
Pipeline
PipelineStage
Opportunity
OpportunityStageHistory
OpportunityContactRole
OpportunityProductInterest
OpportunityCompetitor
OpportunityLossReason
OpportunityForecast
Activity
ActivityParticipant
ActivityTarget
Task
Note
Meeting
Call
TimelineEvent
Reminder
Campaign
CampaignMember
TargetList
TargetListMember
CampaignTouch
CampaignResponse
Source
UtmAttribution
CaseRecord
CaseType
CaseStatus
CaseThread
CaseSla
CaseEscalation
CaseResolution
QuoteIntent
QuoteLineIntent
CommercialTerm
DiscountApproval
RelatingObjectDefinition
RelatingFieldDefinition
RelatingFieldOption
RelatingRelationshipDefinition
RelatingLayoutDefinition
RelatingViewDefinition
RelatingViewFilter
RelatingViewSort
RelatingViewColumn
RelatingKanbanDefinition
RelatingCalendarDefinition
RelatingDashboardDefinition
AutomationRule
AutomationTrigger
AutomationCondition
AutomationAction
AutomationRun
AutomationRunStep
AutomationError
AiSuggestion
AiScoringRun
AiEnrichmentRun
AiDraft
AiDecisionLog
AiSignal
DuplicateCandidate
MergeProposal
```

### Neighbor-owned references

```text
VendorReference
ProductReference
OrderReference
PaymentReference
ShipmentReference
MessageThreadReference
AccessSubjectReference
ProjectReference
DocumentReference
MessageTemplateReference
DocumentTemplateReference
MembershipReference
ContributionReference
EventReference
UserReference
TenantReference
```

## Naming decision

Use `Relating` for the component and `Relationship` for the root object.

Do not use `Crm`, `Crming`, `Customer`, `CustomerRelationshipManagement`, `Account`, or `Contact` as component/root names.
