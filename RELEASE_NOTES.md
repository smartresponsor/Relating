# Relating Relationship Skeleton 0.1.0-rc.1

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

## Release status

This archive is the first pre-install release candidate for the `Relating` / `Relationship` skeleton.

```text
Component: Relating
Root object: Relationship
Market category: CRM
Version: 0.1.0-rc.1
Status: pre-install RC freeze
```

## Freeze rule

After this RC, the skeleton is frozen for the first extraction pass.

Do not add new object families, routes, controllers, messages, services, policies, read models, or documentation branches until the archive has been extracted into the local repository and the first install validation has been reviewed.

Allowed changes before first extraction:

```text
archive integrity fixes
manifest/hash fixes
install script fixes
syntax fixes
broken documentation link fixes
```

Not allowed before first extraction:

```text
new CRM feature scope
new CRUD surface
new neighbor ownership
new migrations
new SQL files
new bundle layer
new /src/Domain path
```

## Included scope

The RC includes the cumulative skeleton waves through S17:

```text
source vacuum documentation
canonical object matrix
boundary ADR pack
EntityFirst skeleton
business repository/service contracts
ViewObject/API contracts
neighbor reference contracts
fixtures/demo-seed readiness
application service skeleton
business route handler skeleton
Symfony config .dist drafts
Messenger handler skeleton
read-model/projector skeleton
validation/policy skeleton
audit/decision trace skeleton
package/install readiness
release packaging quality
final gap cleanup
pre-install RC freeze
```

## Hard boundaries

```text
No CRUD routes.
No CRUD controllers.
No CRUD YAML declarations.
No migrations inside skeleton.
No direct SQL files.
No Symfony Bundle magic.
No /src/Domain.
No neighbor ownership leaks.
No Doctrine entity leakage through ViewObject/API boundary.
```

## First extraction flow

Recommended Windows flow:

```powershell
cd D:\PhpstormProjects\www\Relating

# Place these files here:
# relating-relationship-skeleton.zip
# relating-relationship-skeleton.zip.sha256
# install-from-local-zip.ps1

.\install-from-local-zip.ps1 -SourceZip .elating-relationship-skeleton.zip -TargetPath .
.	oolserify-relating-manifest.ps1 -Root .
.	oolsalidate-relating-package.ps1 -Root .
.	oolsalidate-relating-final-gap.ps1 -Root .
```

## Next allowed step

After extraction and validation, the next work item is not more skeleton expansion. The next step is local repository inspection and a concrete install diff against the actual Symfony host/component state.
