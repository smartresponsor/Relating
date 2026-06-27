# Archive Hash Verification

Relating archives are distributed with a sidecar SHA256 file.

## Expected files

```text
relating-relationship-skeleton.zip
relating-relationship-skeleton.zip.sha256
```

The sidecar file should contain the archive hash and, optionally, the archive file name.

## Windows verification

```powershell
cd D:\PhpstormProjects\www\Relating
Get-FileHash -Algorithm SHA256 .\relating-relationship-skeleton.zip
Get-Content .\relating-relationship-skeleton.zip.sha256
```

Or use the release helper:

```powershell
.\tools\verify-relating-archive.ps1 -ArchivePath .\relating-relationship-skeleton.zip -HashPath .\relating-relationship-skeleton.zip.sha256
```

## Release rule

A hash mismatch means the archive must not be unpacked or applied.
