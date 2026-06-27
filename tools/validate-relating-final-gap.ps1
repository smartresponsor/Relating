param(
    [string]$Root = "."
)

$ErrorActionPreference = 'Stop'
Set-StrictMode -Version Latest

$resolvedRoot = (Resolve-Path $Root).Path
$src = Join-Path $resolvedRoot 'src\Relating'

if (-not (Test-Path $src -PathType Container)) {
    throw "Missing src\Relating under $resolvedRoot"
}

$forbidden = @(
    'Create',
    'Update',
    'Delete',
    'Remove',
    'Removed',
    'MassUpdate',
    'mass_update',
    'EntityManagerInterface',
    'SELECT ',
    'INSERT ',
    'UPDATE ',
    'DELETE '
)

$violations = @()
Get-ChildItem -Path $src -Recurse -File -Include *.php | ForEach-Object {
    $content = Get-Content -Raw -Path $_.FullName
    foreach ($needle in $forbidden) {
        if ($content.Contains($needle)) {
            $violations += "$($_.FullName): $needle"
        }
    }
}

if ($violations.Count -gt 0) {
    $violations | ForEach-Object { Write-Host $_ }
    throw "Relating final gap validation failed."
}

Write-Host "Relating final gap validation passed: $resolvedRoot"
