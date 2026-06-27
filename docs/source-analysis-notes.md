# Relating Source Analysis Notes

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

These notes summarize the first CRM source vacuum wave.

## Twenty

Accepted:

```text
objects
custom objects
fields
relation fields
views
pipelines
workflows
agents
notes
tasks
opportunities
people/companies as source concepts only
```

Relating transformation:

```text
People/Companies -> VendorReference
Opportunities -> Opportunity
Notes/Tasks -> Note/Task/Activity/TimelineEvent
Objects/Fields/Views -> Relating metadata registry
Workflows/Agents -> AutomationRule + AiSuggestion + AiDecisionLog
```

Rejected:

```text
TypeScript/NestJS/Nx architecture
GraphQL-first dependency
CRUD API surface as Relating responsibility
foreign route conventions
```

## EspoCRM

Accepted:

```text
Entity Manager
fields
relationships
Layout Manager
list/detail/edit/search/mass-update layouts
relationship panels
roles/portal/security as concepts only
```

Relating transformation:

```text
Entity Manager -> RelatingObjectDefinition / RelatingFieldDefinition
Relationships -> RelatingRelationshipDefinition
Layouts -> RelatingLayoutDefinition + ViewObjects
Security -> Accessing reference only
```

Rejected:

```text
runtime metadata that bypasses EntityFirst canon
CRUD controller generation inside Relating
```

## SuiteCRM

Accepted:

```text
wide module catalog
lead conversion
opportunity pipeline
calls/meetings/tasks/notes
campaigns/targets/target lists
cases
workflow concepts
AOS quote/contract concepts as commercial intent
```

Relating transformation:

```text
Accounts/Contacts -> Vendoring
Leads -> Lead
Opportunities -> Opportunity
Calls/Meetings/Tasks/Notes -> Activity/Timeline
Campaigns/Targets -> Campaign/TargetList/CampaignMember
Cases -> CaseRecord
Quotes/Contracts -> QuoteIntent/CommercialTerm
Invoices -> Ordering/Payment references only
```

Rejected:

```text
legacy module architecture
SQL-first reports
Accounts/Contacts duplication
post-opportunity ERP ownership inside Relating
```

## OroCRM

Accepted:

```text
customer 360 view
sales pipeline
account/contact management concepts
communication history
marketing campaigns
campaign performance
commerce-adjacent interaction signals
```

Relating transformation:

```text
Customer360 -> RelationshipProfileView
Account/contact info -> VendorReference
Communication -> TimelineEvent/MessageThreadReference
Product views/support tickets -> RelationshipSignal/CaseRecord
Campaign performance -> CampaignPerformanceView
```

Rejected:

```text
full OroPlatform dependency
commerce ownership inside Relating
```

## Krayin

Accepted:

```text
SMB-friendly lead/person/organization/quote/product/activity surface
custom attributes
quick-add style form idea
events/listeners as business automation signal
pipeline/source/tagging concepts
```

Relating transformation:

```text
Attributes -> RelatingFieldDefinition
Quick add -> Business command form/view object
Persons/Organizations -> VendorReference
Quotes -> QuoteIntent
Products -> ProductReference/OpportunityProductInterest
```

Rejected:

```text
Laravel package structure
EAV without strict EntityFirst constraints
CRUD ownership inside Relating
```

## CiviCRM

Accepted:

```text
constituent relationship perspective
contacts/relationships/activities/groups/tags
contributions/events/memberships/cases/campaigns/mailings/reports as relationship signals
```

Relating transformation:

```text
Contacts -> VendorReference
Relationships -> Relationship/RelationshipRelation
Activities -> Activity/TimelineEvent
Groups/Tags -> Segment/TargetList concept
Cases -> CaseRecord
Campaigns/Mailings -> Campaign/CampaignTouch
Contributions -> PaymentReference signal
```

Rejected:

```text
CMS plugin coupling
nonprofit-specific ownership that belongs in future separate components
```
