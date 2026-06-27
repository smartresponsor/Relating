param(
    [string]$BaseUrl = 'http://127.0.0.1:8765',
    [int]$TimeoutSeconds = 15
)

$ErrorActionPreference = 'Stop'
Set-StrictMode -Version Latest

function Assert-Equals {
    param([object]$Expected, [object]$Actual, [string]$Message)

    if ($Expected -ne $Actual) {
        throw "$Message Expected '$Expected', got '$Actual'."
    }
}

function Assert-NotBlank {
    param([object]$Value, [string]$Message)

    if ($null -eq $Value -or [string]::IsNullOrWhiteSpace([string]$Value)) {
        throw $Message
    }
}

function Invoke-RelatingJson {
    param(
        [string]$Method,
        [string]$Path,
        [object]$Payload = $null
    )

    $uri = $BaseUrl.TrimEnd('/') + $Path
    $arguments = @(
        '--location',
        '--insecure',
        '--silent',
        '--show-error',
        '--max-time',
        [string]$TimeoutSeconds,
        '--request',
        $Method.ToUpperInvariant(),
        '--header',
        'Accept: application/json',
        '--header',
        'Content-Type: application/json'
    )

    if ($null -ne $Payload) {
        $json = $Payload | ConvertTo-Json -Depth 16 -Compress
        $arguments += @('--data', $json)
    }

    $arguments += $uri
    $body = (& curl.exe @arguments 2>&1) -join "`n"

    if ($LASTEXITCODE -ne 0) {
        throw "$Method $Path failed with curl exit code ${LASTEXITCODE}: $body"
    }

    if ([string]::IsNullOrWhiteSpace($body)) {
        throw "$Method $Path returned an empty response body."
    }

    $decoded = $body | ConvertFrom-Json -ErrorAction Stop

    return [pscustomobject]@{
        StatusCode = 200
        FinalUrl = $uri
        Json = $decoded
        Raw = $body
    }
}

function Assert-BusinessResult {
    param([object]$Response, [string]$BusinessAction)

    Assert-Equals 'Relating' $Response.Json.component "$BusinessAction component mismatch."
    Assert-Equals $BusinessAction $Response.Json.business_action "$BusinessAction action mismatch."
    Assert-NotBlank $Response.Json.subject_reference "$BusinessAction subject_reference is empty."

    if ($null -eq $Response.Json.payload) {
        throw "$BusinessAction payload is missing."
    }
}

function Assert-NoCrudSurface {
    param([string]$Raw)

    $forbidden = @('/create', '/read', '/update', '/delete', '/list', '/show', '/edit', 'crud')
    $lower = $Raw.ToLowerInvariant()

    foreach ($needle in $forbidden) {
        if ($lower.Contains($needle)) {
            throw "Forbidden CRUD surface '$needle' found in live response."
        }
    }
}

$scenario = 'live-' + [DateTimeOffset]::UtcNow.ToUnixTimeMilliseconds()
$vendorReference = "vendor-$scenario"
$tenantReference = "tenant-$scenario"
$ownerReference = "owner-$scenario"
$pipelineReference = "pipeline-$scenario"
$stageReference = "stage-new-$scenario"

$catalog = Invoke-RelatingJson -Method 'GET' -Path '/relating/catalog'
Assert-Equals 'Relating' $catalog.Json.component 'Catalog component mismatch.'
Assert-Equals 'CRM' $catalog.Json.marketCategory 'Catalog marketCategory mismatch.'
Assert-Equals 'Relationship' $catalog.Json.rootObject 'Catalog rootObject mismatch.'
Assert-NoCrudSurface $catalog.Raw
Write-Host "OK catalog $($catalog.FinalUrl)"

$relationship = Invoke-RelatingJson -Method 'POST' -Path '/relating/relationship/start' -Payload @{
    vendor_reference = $vendorReference
    relationship_kind = 'prospect'
    tenant_reference = $tenantReference
    owner_reference = $ownerReference
    source_reference = 'live-smoke'
    context = @{ smoke = $true; scenario = $scenario }
}
Assert-BusinessResult -Response $relationship -BusinessAction 'relationship-start'
$relationshipReference = [string]$relationship.Json.subject_reference
Write-Host "OK relationship-start $relationshipReference"

$lead = Invoke-RelatingJson -Method 'POST' -Path '/relating/lead/capture' -Payload @{
    source_code = 'live-smoke'
    tenant_reference = $tenantReference
    display_name = 'Live Smoke Lead'
    company_name = 'SmartResponsor Smoke'
    email = "lead-$scenario@example.test"
    phone = '+15550001000'
    payload = @{ scenario = $scenario }
}
Assert-BusinessResult -Response $lead -BusinessAction 'lead-capture'
$leadReference = [string]$lead.Json.subject_reference
Write-Host "OK lead-capture $leadReference"

$qualifiedLead = Invoke-RelatingJson -Method 'POST' -Path '/relating/lead/qualify' -Payload @{
    lead_reference = $leadReference
    score = 72
    temperature = 'warm'
    context = @{ scenario = $scenario }
}
Assert-BusinessResult -Response $qualifiedLead -BusinessAction 'lead-qualification'
Write-Host "OK lead-qualification $leadReference"

$convertedLead = Invoke-RelatingJson -Method 'POST' -Path '/relating/lead/convert' -Payload @{
    lead_reference = $leadReference
    vendor_reference = $vendorReference
    pipeline_reference = $pipelineReference
    stage_reference = $stageReference
    opportunity_name = 'Live smoke conversion opportunity'
    context = @{ scenario = $scenario }
}
Assert-BusinessResult -Response $convertedLead -BusinessAction 'lead-conversion'
Write-Host "OK lead-conversion $leadReference"

$opportunity = Invoke-RelatingJson -Method 'POST' -Path '/relating/opportunity/open' -Payload @{
    relationship_reference = $relationshipReference
    pipeline_reference = $pipelineReference
    stage_reference = $stageReference
    name = 'Live smoke opportunity'
    tenant_reference = $tenantReference
    product_reference = "product-$scenario"
    currency = 'USD'
    amount_minor = 125000
    context = @{ scenario = $scenario }
}
Assert-BusinessResult -Response $opportunity -BusinessAction 'opportunity-open'
$opportunityReference = [string]$opportunity.Json.subject_reference
Write-Host "OK opportunity-open $opportunityReference"

$stageTransition = Invoke-RelatingJson -Method 'POST' -Path '/relating/opportunity/stage-transition' -Payload @{
    opportunity_reference = $opportunityReference
    stage_reference = "stage-qualified-$scenario"
    probability = 65
    forecast_category = 'pipeline'
    context = @{ scenario = $scenario }
}
Assert-BusinessResult -Response $stageTransition -BusinessAction 'opportunity-stage-transition'
Write-Host "OK opportunity-stage-transition $opportunityReference"

$activity = Invoke-RelatingJson -Method 'POST' -Path '/relating/activity/record' -Payload @{
    target_type = 'relationship'
    target_reference = $relationshipReference
    activity_type = 'task'
    direction = 'internal'
    relationship_reference = $relationshipReference
    owner_reference = $ownerReference
    subject = 'Live smoke activity'
    body = 'Runtime live POST smoke activity.'
    payload = @{ scenario = $scenario }
}
Assert-BusinessResult -Response $activity -BusinessAction 'activity-record'
Write-Host "OK activity-record $($activity.Json.subject_reference)"

$timeline = Invoke-RelatingJson -Method 'POST' -Path '/relating/timeline/project' -Payload @{
    target_type = 'relationship'
    target_reference = $relationshipReference
    event_kind = 'neighbor_signal_captured'
    relationship_reference = $relationshipReference
    source_component = 'Relating'
    source_reference = $activity.Json.subject_reference
    payload = @{ scenario = $scenario }
}
Assert-BusinessResult -Response $timeline -BusinessAction 'timeline-project'
Write-Host "OK timeline-project $($timeline.Json.subject_reference)"

Write-Host "Relating live business POST smoke passed for scenario $scenario."
