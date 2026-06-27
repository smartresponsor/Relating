# Route import notes

Relating has exactly one route import file:

```text
config/routes/relating.yaml
```

The route file imports controller attributes from:

```text
src/Controller
```

Controllers are allowed only for business operations. The existing CRUD mechanism
is responsible for all entity list/detail/create/update/delete surfaces.

## Approved route name pattern

```text
relating_<business_surface>
```

Examples:

```text
relating_relationship_start
relating_lead_capture
relating_lead_qualify
relating_lead_convert
relating_opportunity_open
relating_opportunity_stage_transition
relating_activity_record
relating_timeline_project
relating_ai_suggestion_review
```

## Forbidden route name fragments

```text
_index
_create
_read
_update
_delete
_list
_show
_edit
_store
_patch
_remove
```

## No YAML CRUD declarations

YAML routes must not define per-entity CRUD endpoints. Relating YAML is only a
controller import boundary plus comments explaining the hard rule.
