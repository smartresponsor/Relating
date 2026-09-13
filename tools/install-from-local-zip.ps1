param(
    [string]$SourceZip = "",
    [string]$TargetPath = "",
    [string]$ExpectedHash = "",
    [switch]$KeepUnpacked,
    [switch]$SkipHashCheck
)

$ErrorActionPreference = 'Stop'
Set-StrictMode -Version Latest

$ArchiveName = 'relating-relationship-skeleton.zip'

function Resolve-ScriptRootPath {
    if ($PSScriptRoot) {
        return (Resolve-Path $PSScriptRoot).Path
    }

    return (Get-Location).Path
}

function Resolve-TargetRoot {
    param([string]$ExplicitTargetPath)

    if ($ExplicitTargetPath -ne '') {
        return (Resolve-Path $ExplicitTargetPath).Path
    }

    $scriptRoot = Resolve-ScriptRootPath
    return (Resolve-Path (Join-Path $scriptRoot '..')).Path
}

function Resolve-ExpectedHash {
    param(
        [string]$ExplicitExpectedHash,
        [string]$ZipPath
    )

    if ($ExplicitExpectedHash -ne '') {
        return $ExplicitExpectedHash.ToLowerInvariant()
    }

    $shaPath = $ZipPath + '.sha256'
    if (Test-Path $shaPath -PathType Leaf) {
        $raw = (Get-Content -Raw -Path $shaPath).Trim()
        $first = ($raw -split '\s+')[0]
        if ($first -match '^[a-fA-F0-9]{64}$') {
            return $first.ToLowerInvariant()
        }
    }

    return ''
}

$targetRoot = Resolve-TargetRoot -ExplicitTargetPath $TargetPath

if ($SourceZip -eq '') {
    $SourceZip = Join-Path $targetRoot $ArchiveName
}

if (-not (Test-Path $SourceZip -PathType Leaf)) {
    throw "Archive not found: $SourceZip. Place $ArchiveName into $targetRoot or pass -SourceZip."
}

if (-not $SkipHashCheck) {
    $expected = Resolve-ExpectedHash -ExplicitExpectedHash $ExpectedHash -ZipPath $SourceZip
    if ($expected -eq '') {
        throw "Expected hash was not provided and $SourceZip.sha256 was not found or invalid. Pass -ExpectedHash or -SkipHashCheck."
    }

    $actualHash = (Get-FileHash -Algorithm SHA256 -Path $SourceZip).Hash.ToLowerInvariant()
    if ($actualHash -ne $expected) {
        throw "Archive hash mismatch. Expected $expected but got $actualHash."
    }

    Write-Host "Archive SHA256 verified: $expected"
}

$unpackRoot = Join-Path $targetRoot ('.relating-skeleton-unpack-' + [guid]::NewGuid().ToString('N'))

New-Item -ItemType Directory -Path $unpackRoot | Out-Null
Expand-Archive -Force -Path $SourceZip -DestinationPath $unpackRoot

$sourceRoot = Join-Path $unpackRoot 'relating-relationship-skeleton'

if (-not (Test-Path $sourceRoot -PathType Container)) {
    $children = @(Get-ChildItem -Path $unpackRoot -Directory)

    if ($children.Count -eq 1) {
        $sourceRoot = $children[0].FullName
    }
}

if (-not (Test-Path $sourceRoot -PathType Container)) {
    throw "Unable to find extracted skeleton root under $unpackRoot."
}

$itemsToCopy = @(
    'src',
    'tests',
    'docs',
    'config',
    'tools',
    'README.md',
    'RELEASE_NOTES.md',
    'VERSION',
    'MANIFEST.json'
)

foreach ($item in $itemsToCopy) {
    $from = Join-Path $sourceRoot $item

    if (Test-Path $from) {
        Copy-Item -Recurse -Force -Path $from -Destination $targetRoot
    }
}

if (-not $KeepUnpacked -and (Test-Path $unpackRoot -PathType Container)) {
    [System.IO.Directory]::Delete($unpackRoot, $true)
}

Write-Host "Relating skeleton installed into: $targetRoot"
