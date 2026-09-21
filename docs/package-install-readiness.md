# S14 Package and Install Readiness

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This document defines the installation shape for the `Relating` / `Relationship` skeleton.

`Relating` is delivered as a Symfony-oriented dual-runtime component: it remains independently bootable for verification/debugging and exposes `App\Relating\RelatingBundle` for explicit host composition. It is not a CRUD module. The host Symfony application still owns environment-specific persistence, security integration, deployment configuration, and generated migrations.

## Canon

```text
Component: Relating
Root object: Relationship
Market category: CRM
Namespace: App\Relating
Source path: src
Test path: tests
Route file: config/routes/relation_routes.yaml
```

## Installation contract

The package may install these skeleton surfaces:

```text
src
config/routes/relation_routes.yaml
config/*.dist
config/packages/*.dist
config/services/*.dist
docs
tests
tools
MANIFEST.json
README.md
```

The package must not install these surfaces:

```text
src/Domain
migrations
var
vendor
node_modules
CRUD route files
CRUD controllers
SQL migration files
```

## Business route only

The active route file is limited to the approved business route surface:

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

No CRUD route is part of this package. CRUD remains the responsibility of the existing SmartResponsor CRUD mechanism.

## Install sequence

Recommended local sequence:

```powershell
cd D:\PhpstormProjects\www\Relating
.\install-from-local-zip.ps1 -SourceZip .elating-relationship-skeleton.zip -TargetPath .
.	oolsalidate-relating-package.ps1 -Root .
```

Host application integration should happen only after the validation script passes.
