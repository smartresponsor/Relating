# Pre-install RC Freeze

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

`Relating` is now frozen as `0.1.0-rc.1` for the first extraction pass.

The purpose of this freeze is to stop uncontrolled skeleton expansion before the archive is installed into the real local repository. From this point, the skeleton is treated as an installable release candidate rather than a brainstorming canvas.

## Freeze decision

```text
Version: 0.1.0-rc.1
Component: Relating
Root object: Relationship
Market label: CRM
Freeze type: pre-install RC
```

## Allowed before extraction

```text
fix archive hash sidecar
fix manifest inventory
fix PowerShell install script
fix syntax errors
fix broken documentation links
fix packaging metadata
```

## Not allowed before extraction

```text
add new feature objects
add new route families
add CRUD route surface
add CRUD controllers
add CRUD YAML declarations
add migrations
add SQL files
add Bundle classes
add /src/Domain
move ownership from neighbors into Relating
```

## Why freeze now

The skeleton already contains the canonical CRM-grade Relating boundary: relationship lifecycle, leads, opportunities, activities, timeline, campaign, case, automation, AI review, policy, traces, read models, and neighbor references.

Further additions should be driven by the real repository state after extraction, not by abstract expansion.
