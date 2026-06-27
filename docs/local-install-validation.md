# Local Install Validation

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This document defines the local checks for a downloaded Relating skeleton archive.

## Validation command

```powershell
cd D:\PhpstormProjects\www\Relating
.	oolsalidate-relating-package.ps1 -Root .
```

## Checked boundaries

The script checks:

```text
PHP syntax for src/Relating and tests/Relating
forbidden src/Domain path
forbidden Bundle class
forbidden migrations directory
forbidden SQL files
forbidden CRUD route tokens in config/routes/relating.yaml
forbidden CRUD controller action names
presence of required docs
presence of required install files
```

## Expected result

```text
Relating package validation passed.
```

Any failure should be treated as a packaging problem, not as a host application problem.

## Doctrine note

The skeleton is EntityFirst. It does not ship migrations. Doctrine migration diff belongs to the host application after the host app confirms mapping rules, table naming rules, and deployment policy.
