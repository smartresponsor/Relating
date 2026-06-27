# S16 Pre-Install Release Candidate Checklist

Use this checklist before the first real install into `D:\PhpstormProjects\www\Relating` or the host app.

## Archive checks

```powershell
Get-FileHash -Algorithm SHA256 .\relating-relationship-skeleton.zip
Get-Content .\relating-relationship-skeleton.zip.sha256
```

## Unpack checks

```powershell
Expand-Archive -Force .\relating-relationship-skeleton.zip .\var\relating-skeleton-check
Get-ChildItem .\var\relating-skeleton-check\relating-relationship-skeleton
```

## Package checks

```powershell
.\tools\verify-relating-manifest.ps1 -Root .
.\tools\validate-relating-package.ps1 -Root .
```

## Boundary checks

Confirm that the extracted package contains none of these:

- `src/Domain`
- `migrations`
- `vendor`
- `node_modules`
- `.sql` files
- `*Bundle.php`
- CRUD route declarations
- CRUD controllers

## First install rule

After the first successful install, future work should move from cumulative ZIP mode to direct repository mode only after the user confirms the folder state.
