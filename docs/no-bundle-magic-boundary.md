# No Bundle Magic Boundary

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

`Relating` is not introduced as a Symfony Bundle in this skeleton.

## Why

The component is developed under the default Symfony application namespace:

```text
App
```

A Bundle class would introduce a second registration mechanism and would weaken the explicit host-app wiring model.

## Forbidden

```text
RelatingBundle.php
DependencyInjection/RelatingExtension.php
Resources/config/services.yaml as bundle resource
Bundle auto-registration
```

## Allowed

```text
config/services/relating.yaml.dist
config/packages/relating_messenger.yaml.dist
config/packages/relating_workflow.yaml.dist
config/routes/relating.yaml
```

These files are explicit host application templates. They are reviewed and imported by the host app deliberately.

## Boundary statement

Relating must stay a Symfony-oriented source component, not a hidden framework plugin.
