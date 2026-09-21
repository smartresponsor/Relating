# No Bundle Magic Boundary

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

`Relating` exposes a minimal `App\Relating\RelatingBundle` composition surface while remaining independently bootable as a standalone Symfony application.

## Why

The component follows the Canon018 namespace derived from `relating/relation`:

```text
App\Relating
```

The bundle marker exists only for explicit dual-runtime composition. It must not become a second hidden owner of CRUD, persistence, migrations, navigation, or neighboring component behavior.

## Required

```text
src/RelatingBundle.php
config/bundles.php standalone registration
```

## Forbidden

```text
hidden CRUD route/controller registration
bundle-owned migrations or direct SQL
neighbor entity ownership
alternative namespace roots outside App\Relating\
```

## Allowed

```text
config/services/relating.yaml.dist
config/packages/relating_messenger.yaml.dist
config/packages/relating_workflow.yaml.dist
config/routes/relation_routes.yaml
```

These files are explicit host application templates. They are reviewed and imported by the host app deliberately.

## Boundary statement

Relating must stay a Symfony-oriented source component, not a hidden framework plugin.
