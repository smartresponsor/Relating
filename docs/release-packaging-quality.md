# S15 Release Packaging Quality

S15 turns the Relating / Relationship skeleton into a package that can be moved, unpacked, checked, and reviewed without losing the architecture boundary.

## Release goals

- Keep the archive cumulative.
- Keep the root folder stable: `relating-relationship-skeleton`.
- Keep `MANIFEST.json` as the package inventory source.
- Keep SHA256 verification outside the archive in `relating-relationship-skeleton.zip.sha256`.
- Keep install scripts explicit and Windows-friendly.
- Keep validation local and deterministic.

## Hard release boundaries

The release package must not introduce:

```text
CRUD controllers
CRUD routes
CRUD YAML declarations
index/create/read/update/delete/list/show/edit/store/patch/remove route surfaces
Doctrine migrations
SQL files
Symfony Bundle classes
src/Domain
vendor
node_modules
neighbor-owned entities
```

Relating remains a CRM-oriented business lifecycle component. CRUD remains owned by the existing SmartResponsor CRUD mechanism.

## Release artifacts

```text
relating-relationship-skeleton.zip
relating-relationship-skeleton.zip.sha256
install-from-local-zip.ps1
tools/validate-relating-package.ps1
tools/verify-relating-manifest.ps1
tools/verify-relating-archive.ps1
```

## Required local checks

```powershell
cd D:\PhpstormProjects\www\Relating
.\tools\validate-relating-package.ps1 -Root .
.\tools\verify-relating-manifest.ps1 -Root .
```

After downloading the archive and hash file:

```powershell
.\tools\verify-relating-archive.ps1 -ArchivePath .\relating-relationship-skeleton.zip -HashPath .\relating-relationship-skeleton.zip.sha256
```
