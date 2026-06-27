# S8 Symfony wiring skeleton

`Relating` is installed as a Symfony-oriented component under `App`.
This wave adds wiring skeletons only. It does not enable persistence, migrations,
CRUD routing, or SQL-first infrastructure.

## Files

```text
config/services/relating.yaml.dist
config/packages/relating_messenger.yaml.dist
config/packages/relating_workflow.yaml.dist
config/relating_wiring.yaml.dist
```

## Service wiring rule

`Relating` services are registered by namespace, but entities, enums, values,
view DTOs, messages, events, commands, and results are excluded from autowired
service registration.

The active service surfaces are:

```text
App\Application\Service
App\Service
App\Controller
```

## Route wiring rule

`config/routes/relating.yaml` imports only controllers under
`src/Controller`, and tests enforce that controllers expose business
routes only.

Allowed route examples:

```text
/relating/relationship/start
/relating/lead/capture
/relating/lead/qualify
/relating/lead/convert
/relating/opportunity/open
/relating/opportunity/stage-transition
/relating/activity/record
/relating/timeline/project
/relating/ai-suggestion/review
```

Forbidden route examples:

```text
/relating/lead/create
/relating/lead/{id}/read
/relating/lead/{id}/update
/relating/lead/{id}/delete
/relating/opportunity/list
/relating/opportunity/show
/relating/opportunity/edit
```

## Messenger wiring rule

Messenger routing is a `.dist` draft. It should be copied or imported only after
host application transport policy is ready.

Allowed messages are business-named:

```text
QualifyLeadMessage
ConvertLeadMessage
BuildRelationshipTimelineMessage
RecalculateRelationshipHealthMessage
RaiseAiSuggestionMessage
ReviewAiSuggestionMessage
```

Forbidden message forms:

```text
Create*Message
Update*Message
Delete*Message
Save*Message
Persist*Message
Flush*Message
```
