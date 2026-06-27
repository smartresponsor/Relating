# S14 Package and Install Readiness

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This document defines the installation shape for the `Relating` / `Relationship` skeleton.

`Relating` is delivered as a Symfony-oriented source package, not as a framework bundle and not as a CRUD module. The package is intended to be copied into a host Symfony application that already owns application bootstrapping, CRUD machinery, security wiring, persistence configuration, and environment-specific infrastructure.

## Canon

```text
Component: Relating
Root object: Relationship
Market category: CRM
Namespace: App\Relating
Source path: src/Relating
Test path: tests/Relating
Route file: config/routes/relating.yaml
```

## Installation contract

The package may install these skeleton surfaces:

```text
src/Relating
config/routes/relating.yaml
config/*.dist
config/packages/*.dist
config/services/*.dist
docs
tests/Relating
tools
MANIFEST.json
README.md
```

The package must not install these surfaces:

```text
src/Domain
src/*Bundle.php
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
/relating/opportunity/stage-transition
/relating/activity/record
/relating/timeline/project
/relating/ai-suggestion/review
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
