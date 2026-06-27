# Relating Release Checklist

## Before packaging

```text
[ ] README updated with the latest wave.
[ ] MANIFEST.json lists all package files.
[ ] No src/Domain path exists.
[ ] No migrations directory exists.
[ ] No SQL files exist.
[ ] No Symfony Bundle class exists.
[ ] Business routes are the only active routes.
[ ] CRUD route verbs and surfaces are absent.
[ ] PHP files pass php -l.
[ ] ZIP archive opens successfully.
[ ] SHA256 sidecar was regenerated.
```

## After unpacking

```powershell
.\tools\validate-relating-package.ps1 -Root .
.\tools\verify-relating-manifest.ps1 -Root .
```

## Before host-app integration

```text
[ ] Confirm default App\ namespace.
[ ] Confirm no alternative namespace was introduced.
[ ] Import only business route file.
[ ] Keep CRUD generation outside Relating.
[ ] Run host-app tests after Doctrine mapping review.
```
