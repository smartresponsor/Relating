# ADR-001: Relating Owns Relationship Lifecycle, Not CRUD

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

## Status

Accepted.

## Context

Open-source CRM systems usually expose modules as CRUD-first resources: Accounts, Contacts, Leads, Opportunities, Tasks, Notes, Campaigns, Cases, Reports, and many adjacent objects. That model is useful for discovery, but it is not the SmartResponsor architecture.

SmartResponsor already has a CRUD mechanism. `Relating` must not recreate it.

## Decision

`Relating` owns CRM-oriented business lifecycle operations around relationships.

It does not own generic CRUD routes.

```text
Allowed: business action route
Forbidden: CRUD action route
```

## Allowed route families

```text
catalog
qualify
convert
transition
timeline/build
score
review
apply
reject
merge/propose
merge/approve
assign
escalate
resolve
forecast/rebuild
campaign/response/capture
automation/run
ai-suggestion/apply
ai-suggestion/reject
```

## Forbidden CRUD route/action names

```text
index
create
read
update
delete
list
show
edit
store
destroy
patch
put
post-resource
```

`post-resource` means a route whose semantic purpose is generic creation of an entity. POST is allowed only when the operation is a named business action, e.g. `qualify`, `convert`, `transition`, `apply`, `resolve`.

## Controller policy

Allowed controller names:

```text
LeadQualificationController
LeadConversionController
OpportunityTransitionController
RelationshipTimelineController
DuplicateReviewController
AiSuggestionReviewController
CampaignResponseController
CaseEscalationController
CaseResolutionController
AutomationRunController
```

Forbidden controller names:

```text
LeadController
OpportunityController
RelationshipController
ActivityController
CampaignController
CaseController
CrudController
AdminCrudController
```

A plain entity-named controller tends to become CRUD by gravity. Every Relating controller must name a business capability.

## YAML policy

Route declarations in `config/routes/relation_routes.yaml` may reference business controllers only.

They must not declare entity collection/item routes such as:

```text
/relating/lead
/relating/lead/{id}
/relating/opportunity
/relating/opportunity/{id}
```

## Consequences

1. CRUD remains centralized in the existing SmartResponsor CRUD mechanism.
2. Relating remains a business lifecycle component.
3. Open-source CRM legacy module names are transformed into Symfony business capabilities.
4. EntityFirst design remains separate from route exposure.
5. ViewObjects become the API contract, not Doctrine entities.
