# Windows Install Notes

Relating is shipped as a cumulative archive because the laptop connector is not yet writing binary archives directly.

## Manual install flow

```powershell
cd D:\PhpstormProjects\www\Relating

# Place these files in the folder:
# relating-relationship-skeleton.zip
# relating-relationship-skeleton.zip.sha256
# install-from-local-zip.ps1

.\install-from-local-zip.ps1 -SourceZip .\relating-relationship-skeleton.zip -TargetPath .
.\tools\validate-relating-package.ps1 -Root .
.\tools\verify-relating-manifest.ps1 -Root .
```

## Git path note

The current connector showed this error while trying to apply patches:

```text
spawn C:\Program Files\Git\cmd\git.exe ENOENT
```

This does not affect the ZIP package. It only means connector-side git-backed patch application is not available until the Git path is fixed on the laptop or connector host.

## Route boundary reminder

Do not import or generate CRUD routes from this package. `config/routes/relating.yaml` is business-only.
