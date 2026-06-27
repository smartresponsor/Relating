param(
    [string]$ArchivePath = ".\relating-relationship-skeleton.zip",
    [string]$HashPath = ".\relating-relationship-skeleton.zip.sha256"
)

$ErrorActionPreference = 'Stop'
Set-StrictMode -Version Latest

if (-not (Test-Path $ArchivePath -PathType Leaf)) {
    throw "Archive not found: $ArchivePath"
}

if (-not (Test-Path $HashPath -PathType Leaf)) {
    throw "Hash file not found: $HashPath"
}

$actualHash = (Get-FileHash -Algorithm SHA256 -Path $ArchivePath).Hash.ToLowerInvariant()
$hashContent = (Get-Content -Raw -Path $HashPath).Trim().ToLowerInvariant()
$expectedHash = ($hashContent -split '\\s+')[0]

if ($actualHash -ne $expectedHash) {
    throw "Archive hash mismatch. Expected $expectedHash but got $actualHash."
}

try {
    Add-Type -AssemblyName System.IO.Compression.FileSystem
    $zip = [System.IO.Compression.ZipFile]::OpenRead((Resolve-Path $ArchivePath).Path)
    $entryCount = $zip.Entries.Count
    $zip.Dispose()
} catch {
    throw "Archive integrity check failed: $($_.Exception.Message)"
}

Write-Host "Relating archive verification passed. SHA256: $actualHash. Entries: $entryCount"
