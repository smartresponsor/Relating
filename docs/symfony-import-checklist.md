# Symfony Import Checklist

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This checklist is used when importing the skeleton into a Symfony host application.

## Required checks

```text
[ ] src/Relating exists
[ ] tests/Relating exists
[ ] config/routes/relating.yaml exists
[ ] config/services/relating.yaml.dist exists
[ ] config/packages/relating_messenger.yaml.dist exists
[ ] config/packages/relating_workflow.yaml.dist exists
[ ] no src/Domain path exists
[ ] no Bundle class exists
[ ] no migrations are included
[ ] no SQL files are included
[ ] no CRUD routes are included
```

## Route import

The host application may import only the approved business route file:

```yaml
relating_business:
    resource: '../config/routes/relating.yaml'
```

The import must not point to generated CRUD route declarations.

## Service import

The host application may copy `.dist` service definitions into an active host config only after local review:

```text
config/services/relating.yaml.dist
config/packages/relating_messenger.yaml.dist
config/packages/relating_workflow.yaml.dist
```

The `.dist` files are templates. They are intentionally not treated as active host configuration until the host app opts in.

## Validation before host wiring

Run:

```powershell
.	oolsalidate-relating-package.ps1 -Root .
```

The validation must pass before route imports, messenger routing, workflow configuration, or Doctrine mapping are enabled in the host app.
