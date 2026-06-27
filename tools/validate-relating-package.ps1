param(
    [string]$Root = "."
)

$ErrorActionPreference = 'Stop'
Set-StrictMode -Version Latest

$rootPath = (Resolve-Path $Root).Path

function Assert-PathExists {
    param([string]$Path, [string]$Message)

    if (-not (Test-Path $Path)) {
        throw $Message
    }
}

function Assert-PathMissing {
    param([string]$Path, [string]$Message)

    if (Test-Path $Path) {
        throw $Message
    }
}

function Assert-ContentDoesNotContain {
    param([string]$Path, [string[]]$Forbidden)

    if (-not (Test-Path $Path -PathType Leaf)) {
        return
    }

    $content = Get-Content -Raw -Path $Path

    foreach ($needle in $Forbidden) {
        if ($content -match [regex]::Escape($needle)) {
            throw "Forbidden content '$needle' found in $Path"
        }
    }
}

Assert-PathExists (Join-Path $rootPath 'src') 'Missing src.'
Assert-PathExists (Join-Path $rootPath 'tests') 'Missing tests.'
Assert-PathExists (Join-Path $rootPath 'config/routes/relating.yaml') 'Missing business route file.'
Assert-PathExists (Join-Path $rootPath 'README.md') 'Missing README.md.'
Assert-PathExists (Join-Path $rootPath 'MANIFEST.json') 'Missing MANIFEST.json.'

Assert-PathMissing (Join-Path $rootPath 'src/Domain') 'Forbidden src/Domain path exists.'
Assert-PathMissing (Join-Path $rootPath 'migrations') 'Forbidden migrations directory exists.'
Assert-PathMissing (Join-Path $rootPath 'vendor') 'Forbidden vendor directory exists in skeleton package.'
Assert-PathMissing (Join-Path $rootPath 'node_modules') 'Forbidden node_modules directory exists in skeleton package.'

$allowedBundle = 'src/RelatingBundle.php'
$bundleFiles = Get-ChildItem -Path $rootPath -Recurse -File -Filter '*Bundle.php' -ErrorAction SilentlyContinue | Where-Object {
    $_.FullName.Substring($rootPath.Length + 1).Replace('\\', '/') -ne $allowedBundle
}

if ($bundleFiles.Count -gt 0) {
    throw 'Forbidden Symfony Bundle class found outside optional RelatingBundle wrapper.'
}

$sqlFiles = Get-ChildItem -Path $rootPath -Recurse -File -Include '*.sql' -ErrorAction SilentlyContinue
if ($sqlFiles.Count -gt 0) {
    throw 'Forbidden SQL file found.'
}

$routeFile = Join-Path $rootPath 'config/routes/relating.yaml'
Assert-ContentDoesNotContain -Path $routeFile -Forbidden @('/create', '/read', '/update', '/delete', '/list', '/show', '/edit', '/remove')

$phpFiles = Get-ChildItem -Path (Join-Path $rootPath 'src'), (Join-Path $rootPath 'tests') -Recurse -File -Filter '*.php'
foreach ($file in $phpFiles) {
    $result = & php -l $file.FullName 2>&1
    if ($LASTEXITCODE -ne 0) {
        throw "PHP lint failed for $($file.FullName): $result"
    }
}

Write-Host 'Relating package validation passed.'
