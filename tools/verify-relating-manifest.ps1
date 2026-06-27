param(
    [string]$Root = "."
)

$ErrorActionPreference = 'Stop'
Set-StrictMode -Version Latest

$rootPath = (Resolve-Path $Root).Path
$manifestPath = Join-Path $rootPath 'MANIFEST.json'

if (-not (Test-Path $manifestPath -PathType Leaf)) {
    throw "Missing MANIFEST.json at $manifestPath"
}

$manifest = Get-Content -Raw -Path $manifestPath | ConvertFrom-Json
$listed = @($manifest.files) | ForEach-Object { $_.Replace('\\', '/') } | Sort-Object -Unique

$forbiddenDirectories = @('vendor', 'node_modules', 'migrations', 'src/Domain')
foreach ($dir in $forbiddenDirectories) {
    if (Test-Path (Join-Path $rootPath $dir)) {
        throw "Forbidden directory exists: $dir"
    }
}

$actual = Get-ChildItem -Path $rootPath -Recurse -File |
    Where-Object { $_.FullName -notmatch '\\\.git(\\|$)' } |
    ForEach-Object {
        $_.FullName.Substring($rootPath.Length + 1).Replace('\\', '/')
    } |
    Sort-Object -Unique

$missing = @($listed | Where-Object { $_ -notin $actual })
$extra = @($actual | Where-Object { $_ -notin $listed })

if ($missing.Count -gt 0) {
    throw "Manifest lists missing files: $($missing -join ', ')"
}

if ($extra.Count -gt 0) {
    throw "Files missing from manifest: $($extra -join ', ')"
}

$sqlFiles = @($actual | Where-Object { $_ -like '*.sql' })
if ($sqlFiles.Count -gt 0) {
    throw "Forbidden SQL files found: $($sqlFiles -join ', ')"
}

$bundleFiles = @($actual | Where-Object { $_ -like '*Bundle.php' -and $_ -ne 'src/Relating/RelatingBundle.php' })
if ($bundleFiles.Count -gt 0) {
    throw "Forbidden Bundle files found: $($bundleFiles -join ', ')"
}

Write-Host "Relating manifest verification passed. Files: $($actual.Count)"
