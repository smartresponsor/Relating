# Business Route Surface

Relating exposes business routes only. CRUD routes are not generated, declared, or recreated in Relating.

## Allowed route intent verbs

```text
catalog
qualify
convert
transition
score
review
merge-proposal
link
unlink
capture
summarize
suggest
apply-suggestion
reject-suggestion
build-timeline
refresh-forecast
```

## Disallowed CRUD action tokens

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
```

`list` and `show` are treated as CRUD-like route surfaces when they expose entity records directly. Relationship business summaries must use business names such as `catalog`, `timeline`, `profile`, `board`, `review`, or `summary`.

## Examples

Allowed:

```text
GET  /relating/catalog/object
POST /relating/lead/{leadId}/qualify
POST /relating/lead/{leadId}/convert
POST /relating/opportunity/{opportunityId}/transition
GET  /relating/relationship/{relationshipId}/timeline
POST /relating/relationship/{relationshipId}/score
GET  /relating/duplicate/review
POST /relating/ai-suggestion/{suggestionId}/apply
```

Forbidden:

```text
GET    /relating/lead
POST   /relating/lead
GET    /relating/lead/{id}
PUT    /relating/lead/{id}
DELETE /relating/lead/{id}
```

## Implementation note

A route that returns a `ViewObject` can still be forbidden if its intent is merely CRUD record access. Business routes must represent a CRM lifecycle operation or specialized business surface.


## S7 approved business handlers

Relating business handlers are intentionally limited to lifecycle operations. They are not CRUD endpoints.

- relationship-start
- lead-capture
- lead-qualification
- lead-conversion
- opportunity-open
- opportunity-stage-transition
- activity-record
- timeline-projection
- ai-review

No route may be added for generic entity list/detail/create/update/delete behavior.
