# Manifest Verification

`MANIFEST.json` is the package inventory source for Relating.

## Rules

- Every tracked package file must be listed in `MANIFEST.json`.
- `MANIFEST.json` must not list files that are absent from the package.
- Generated local directories are not part of the manifest.
- `vendor`, `node_modules`, `migrations`, `src/Domain`, and SQL files are forbidden.

## Local verification

```powershell
cd D:\PhpstormProjects\www\Relating
.\tools\verify-relating-manifest.ps1 -Root .
```

The verifier compares actual package files to the manifest and fails on missing, extra, or forbidden files.
