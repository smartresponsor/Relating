# Relating Routing Boundary

Relating is a CRM-oriented business component, not a CRUD route provider.

## Hard rule

Relating must not recreate CRUD routes. Existing CRUD responsibility remains outside this component.

The component must not add controllers, route attributes, YAML routes, or route names for CRUD operations.

Reserved CRUD route actions:

```text
index
create
read
update
delete
```

## Allowed business routes

Relating routes may exist only when they express business behavior or a business read model.

Allowed route categories:

- object catalog and CRM capability discovery;
- lead qualification;
- lead conversion;
- opportunity stage transition;
- relationship lifecycle touch/activation/archive;
- timeline build/rebuild;
- activity completion;
- campaign response capture;
- case escalation/resolution;
- duplicate review and merge proposal review;
- automation run;
- AI suggestion review/apply/reject.

Examples:

```text
GET  /relating/catalog
POST /relating/lead/{leadId}/qualify
POST /relating/lead/{leadId}/convert
POST /relating/opportunity/{opportunityId}/transition
POST /relating/relationship/{relationshipId}/timeline/build
POST /relating/campaign/{campaignId}/response/capture
POST /relating/case/{caseId}/escalate
POST /relating/duplicate/{candidateId}/review
POST /relating/automation/{ruleId}/run
POST /relating/ai-suggestion/{suggestionId}/review
```

## Forbidden CRUD routes

Examples that must not be added by Relating:

```text
GET    /relating/lead
GET    /relating/lead/{id}
POST   /relating/lead
PUT    /relating/lead/{id}
PATCH  /relating/lead/{id}
DELETE /relating/lead/{id}
GET    /relating/opportunity
GET    /relating/opportunity/{id}
POST   /relating/opportunity
PUT    /relating/opportunity/{id}
PATCH  /relating/opportunity/{id}
DELETE /relating/opportunity/{id}
```

## Source CRM vacuum rule

When reviewing open-source CRM systems, Relating may vacuum object catalogs, business chains, view models, workflow triggers, state machines, dashboards, duplicate-review logic, campaign attribution and AI/automation surfaces.

Relating must not vacuum CRUD exposure patterns, CRUD controllers, CRUD route naming, SQL-first table access, or legacy module routing conventions.
