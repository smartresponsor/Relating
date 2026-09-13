# S19 Symfony-root Debug Runtime Recovery

S19 keeps local execution in the repository root and rejects auxiliary runtime applications.

The runtime must follow native Symfony root structure:

```text
bin/console
config/bundles.php
config/packages/framework.yaml
config/routes.yaml
config/services.yaml
public/index.php
src/Kernel.php
```

There is no secondary runtime application. Local debug execution starts from the root repository.

## Local server target

Use the root project directory:

```powershell
cd D:\PhpstormProjects\www\Relating
composer install
symfony server:start --port=8765
```

After the server starts, browser checks can inspect:

```text
http://127.0.0.1:8765/relating/catalog
```

## Debug persistence

Local debug repositories are file-backed and write to:

```text
var/relating-debug-store.json
```

This is only for local browser/API inspection. It is not production persistence, not a migration, and not direct SQL.

## Optional bundle wrapper

`src/RelatingBundle.php` remains an optional package integration wrapper.

The root debug app does not rely on bundle magic. It wires services directly through `config/services.yaml`.

Host applications still control Doctrine persistence and migrations.

## Browser-check route surface

The root Symfony debug app imports business controllers by attribute routes:

```text
/relating/catalog
/relating/relationship/start
/relating/lead/capture
/relating/lead/qualify
/relating/lead/convert
/relating/opportunity/open
/relating/opportunity/stage/transition
/relating/activity/record
/relating/timeline/project
/relating/ai/suggestion/review
```

Only business routes are exposed.

## Boundary

```text
No CRUD routes.
No CRUD controllers.
No CRUD YAML declarations.
No migrations in Relating.
No direct SQL files.
No /src/Domain path.
No neighbor ownership transfer.
```
