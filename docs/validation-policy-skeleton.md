# S11 Validation and Policy Skeleton

`Relating` uses validation and policy guards for business lifecycle actions only.

The validation layer is not a CRUD form layer. It does not describe generic list, show, edit, patch, remove, index, store, or admin CRUD operations.

## Scope

S11 adds skeleton contracts for:

- business payload validation;
- application command validation;
- score bounds validation;
- neighbor reference validation;
- transition validation;
- relationship start policy;
- lead qualification policy;
- lead conversion policy;
- opportunity stage transition policy;
- AI suggestion review policy;
- neighbor signal ingestion policy.

## Canon

Validation is attached to approved business actions:

```text
relationship.start
lead.capture
lead.qualify
lead.convert
opportunity.open
opportunity.stage_transition
activity.record
timeline.project
ai_suggestion.review
```

Validation is not attached to CRUD route surfaces.

## Symfony direction

Concrete Symfony Validator constraints may be added by the host application later. This skeleton only defines contracts and value objects.

The host may bind these contracts to Symfony services in `config/services/relating.yaml.dist` without activating any CRUD route.
