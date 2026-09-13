param(
    [string]$Root = ".",
    [switch]$PackageArchive
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
Assert-PathExists (Join-Path $rootPath 'bin/console') 'Missing Symfony console entrypoint.'
Assert-PathExists (Join-Path $rootPath 'public/index.php') 'Missing Symfony public front controller.'
Assert-PathExists (Join-Path $rootPath 'src/Kernel.php') 'Missing native Symfony Kernel.'
Assert-PathExists (Join-Path $rootPath 'config/services.yaml') 'Missing root Symfony service wiring.'
Assert-PathExists (Join-Path $rootPath 'config/routes/relation_routes.yaml') 'Missing business route file.'
Assert-PathExists (Join-Path $rootPath 'README.md') 'Missing README.md.'
Assert-PathExists (Join-Path $rootPath 'MANIFEST.json') 'Missing MANIFEST.json.'

Assert-PathMissing (Join-Path $rootPath 'src/Relating') 'Forbidden second-level src/Relating wrapper exists.'
Assert-PathMissing (Join-Path $rootPath 'tests/Relating') 'Forbidden second-level tests/Relating wrapper exists.'
Assert-PathMissing (Join-Path $rootPath 'runtime/standalone') 'Forbidden legacy standalone runtime path exists.'
Assert-PathMissing (Join-Path $rootPath 'src/Domain') 'Forbidden src/Domain path exists.'
Assert-PathMissing (Join-Path $rootPath 'migrations') 'Forbidden migrations directory exists.'
if ($PackageArchive) { Assert-PathMissing (Join-Path $rootPath 'vendor') 'Forbidden vendor directory exists in skeleton package archive.' }
if ($PackageArchive) { Assert-PathMissing (Join-Path $rootPath 'node_modules') 'Forbidden node_modules directory exists in skeleton package archive.' }

$packageScanRoots = @('src', 'config', 'tests', 'tools', 'docs') | ForEach-Object { Join-Path $rootPath $_ } | Where-Object { Test-Path $_ }

$allowedBundle = 'src/RelatingBundle.php'
$bundleFiles = @(Get-ChildItem -Path $packageScanRoots -Recurse -File -Filter '*Bundle.php' -ErrorAction SilentlyContinue | Where-Object {
    $relativePath = $_.FullName.Substring($rootPath.Length + 1).Replace([char]92, '/')
    $relativePath -ne $allowedBundle
})

if ($bundleFiles.Count -gt 0) {
    throw 'Forbidden Symfony Bundle class found outside optional RelatingBundle wrapper.'
}

$sqlFiles = @(Get-ChildItem -Path $packageScanRoots -Recurse -File -Include '*.sql' -ErrorAction SilentlyContinue)
if ($sqlFiles.Count -gt 0) {
    throw 'Forbidden SQL file found.'
}

$routeFile = Join-Path $rootPath 'config/routes/relation_routes.yaml'
Assert-ContentDoesNotContain -Path $routeFile -Forbidden @('/create', '/read', '/update', '/delete', '/list', '/show', '/edit', '/remove')

$phpFiles = Get-ChildItem -Path (Join-Path $rootPath 'src'), (Join-Path $rootPath 'tests') -Recurse -File -Filter '*.php'
foreach ($file in $phpFiles) {
    $result = & php -l $file.FullName 2>&1
    if ($LASTEXITCODE -ne 0) {
        throw "PHP lint failed for $($file.FullName): $result"
    }

    Assert-ContentDoesNotContain -Path $file.FullName -Forbidden @('App\Relating\', 'App\Tests\Relating\')
}

Assert-PathExists (Join-Path $rootPath 'src/EventSubscriber/BusinessHttpExceptionSubscriber.php') 'Missing business HTTP error contract subscriber.'
Assert-PathExists (Join-Path $rootPath 'tests/RelatingBusinessHttpErrorContractTest.php') 'Missing business HTTP error contract test.'
Assert-PathExists (Join-Path $rootPath 'tools/smoke-relating-business-http.ps1') 'Missing live business HTTP smoke wrapper.'
Assert-PathExists (Join-Path $rootPath 'tools/smoke-relating-business-http-curl.ps1') 'Missing live business HTTP curl smoke.'

$businessErrorSubscriber = Get-Content -Raw -Path (Join-Path $rootPath 'src/EventSubscriber/BusinessHttpExceptionSubscriber.php')
if ($businessErrorSubscriber -notmatch [regex]::Escape('business_reference_not_found') -or $businessErrorSubscriber -notmatch [regex]::Escape('HTTP_NOT_FOUND')) {
    throw 'Missing stable business reference-not-found HTTP subscriber contract.'
}

$businessErrorTest = Get-Content -Raw -Path (Join-Path $rootPath 'tests/RelatingBusinessHttpErrorContractTest.php')
if ($businessErrorTest -notmatch [regex]::Escape('business_reference_not_found') -or $businessErrorTest -notmatch [regex]::Escape('HTTP_NOT_FOUND')) {
    throw 'Missing stable business reference-not-found HTTP test contract.'
}

$businessSmoke = Get-Content -Raw -Path (Join-Path $rootPath 'tools/smoke-relating-business-http-curl.ps1')
if ($businessSmoke -notmatch [regex]::Escape('business_reference_not_found') -or $businessSmoke -notmatch [regex]::Escape('ExpectedStatusCode 404')) {
    throw 'Missing live business reference-not-found smoke contract.'
}

Write-Host 'Relating package validation passed.'
