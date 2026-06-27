# S8 wiring report

S8 adds Symfony wiring skeletons for services, routes, Messenger and workflow
placeholders.

## Added

```text
config/services/relating.yaml.dist
config/packages/relating_messenger.yaml.dist
config/packages/relating_workflow.yaml.dist
config/relating_wiring.yaml.dist
docs/symfony-wiring-skeleton.md
docs/messenger-routing-draft.md
docs/route-import-notes.md
docs/config-boundary-checklist.md
docs/s8-wiring-report.md
tests/Relating/RelatingConfigBoundaryTest.php
tests/Relating/RelatingMessengerRoutingBoundaryTest.php
```

## Corrected

Removed stale `CreateAiSuggestionMessage.php`. AI suggestion creation is expressed
as a business lifecycle message:

```text
RaiseAiSuggestionMessage
```

## Boundary

No CRUD routes, controllers, YAML declarations, CRUD messages, migrations, direct
SQL, or neighbor ownership are introduced in this wave.
