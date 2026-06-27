param(
    [Parameter(Mandatory = $true)]
    [string]$Target
)

$ErrorActionPreference = 'Stop'

$root = Resolve-Path (Join-Path $PSScriptRoot '..')
$targetRoot = Resolve-Path $Target

Set-Location $targetRoot

$items = @('src', 'tests', 'config', 'docs')

foreach ($item in $items) {
    $source = Join-Path $root $item
    if (Test-Path $source) {
        Copy-Item -Path $source -Destination $targetRoot -Recurse -Force
    }
}

Write-Host 'Relating Relationship skeleton installed.'
