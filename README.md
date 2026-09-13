# Relating Relationship Skeleton

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

`Relating` is the CRM-oriented relationship lifecycle component.

It uses the market label `CRM`, but the Symfony namespace stays canonical:

```text
App
```

Root object:

```text
Relationship
```

Relating owns relationships, leads, opportunities, activities, timelines, campaigns, cases, commercial intent, view definitions, automation rules, and AI review objects.

Relating does not own vendors, access rules, products, orders, payments, shipments, projects, or message transport. It references those neighboring components through explicit value objects.

## Install into a Symfony application

From PowerShell:

```powershell
cd D:\PhpstormProjects\www\App
Expand-Archive -Force .\relating-relationship-skeleton.zip .\var\relating-relationship-skeleton
.\var\relating-relationship-skeleton\relating-relationship-skeleton\tools\install-relating-skeleton.ps1 -Target .
php bin/console doctrine:migrations:diff
php bin/phpunit tests
```


## Route boundary

Relating does not recreate CRUD routing. CRUD remains owned by the existing SmartResponsor CRUD mechanism.

Relating may declare only business routes: lifecycle transitions, qualification, conversion, timeline building, scoring, duplicate review, automation runs, AI suggestion review, object catalog and dashboard/business read models.

Relating must not declare CRUD controllers, CRUD YAML routes, CRUD route attributes, or action routes named:

```text
index
create
read
update
delete
```

Allowed examples:

```text
/relating/catalog
/relating/lead/{leadId}/qualify
/relating/lead/{leadId}/convert
/relating/opportunity/{opportunityId}/transition
/relating/relationship/{relationshipId}/timeline/build
/relating/duplicate/{candidateId}/review
/relating/ai-suggestion/{suggestionId}/apply
```

Forbidden examples:

```text
/relating/lead
/relating/lead/{id}
/relating/lead/create
/relating/lead/{id}/read
/relating/lead/{id}/update
/relating/lead/{id}/delete
```

## Namespace

```text
src
```

No `/src/Domain/` path is used.

## Market language

Use `CRM` in UI, README, roadmap, tags, and business positioning.
Use `Relating` in code, routes, service names, and Symfony namespace.

## Current cumulative wave

This archive is cumulative. Until a real workspace folder is confirmed through the connector, new Relating work is accumulated into this ZIP.

Added documentation wave:

```text
docs/open-source-vacuum-plan.md
docs/source-object-matrix.md
docs/source-analysis-notes.md
docs/source-decision-log.md
docs/roadmap.md
```

The current wave is documentation-first. It vacuums open-source CRM object/view/workflow knowledge into the Relating canon while preserving the Symfony boundary and the business-route-only rule.


## Wave D2 documentation vacuum

Added detailed source vacuum notes for Twenty, EspoCRM, and SuiteCRM, plus business-chain, ViewObject-roadmap, and anti-pattern rejection documents. The skeleton now includes RelationshipParticipant and RelationshipSignal as first-class Relating objects while still preserving the hard no-CRUD route boundary.

## Wave D3 documentation vacuum

Added OroCRM, Krayin, and CiviCRM vacuum notes.

This wave strengthens three surfaces:

```text
OroCRM  -> sales lifecycle, lead qualification, opportunity workflow, forecast/dashboard surfaces
Krayin  -> compact SMB CRM UX, custom attributes, quick-add discipline, quote intent
CiviCRM -> relationship graph, activities, nonprofit/community lifecycle, contribution/member/event references
```

Added boundary documents:

```text
docs/neighbor-contract-catalog.md
docs/business-route-surface.md
```

The route boundary remains unchanged: Relating creates business routes only and never recreates CRUD routes.

## Wave A1/A2 architecture normalization

Added normalization documents:

```text
docs/canonical-object-matrix.md
docs/boundary-adr-001-relating-owns-relationship-not-crud.md
docs/implementation-milestone-map.md
docs/view-api-contract.md
docs/source-coverage-report.md
docs/event-message-catalog.md
```

This wave converts the discovery/vacuum notes into a canonical implementation map:

```text
A1 canonical object matrix
A2 hard boundary ADR
A3 implementation milestone map
A4 ViewObject API contract
A5 event/message catalog
```

The route boundary remains unchanged: Relating creates business routes only and never creates CRUD controllers, CRUD YAML declarations, route attributes, or index/create/read/update/delete actions.

## Wave A6 workflow and automation normalization

Added workflow/automation matrix documents and expanded event/message skeletons:

```text
docs/automation-workflow-matrix.md
docs/automation-trigger-condition-action-catalog.md
docs/ai-suggestion-lifecycle.md
docs/messenger-message-roadmap.md
docs/automation-security-guardrails.md
tests/RelatingEventBoundaryTest.php
```

This wave also removes generic CRUD-like Relating event class names:

```text
RelationshipCreated -> RelationshipStarted
OpportunityCreated  -> OpportunityOpened
AiSuggestionCreated -> AiSuggestionRaised
```

Relating automation remains business-only and does not introduce CRUD routes, CRUD controllers, CRUD YAML declarations, or generic Created/Updated/Deleted entity events.



## S1 EntityFirst correction

The skeleton now includes a stronger Doctrine-ready EntityFirst layer for `Relationship`, `Lead`, `Opportunity`, `Pipeline`, `Activity`, `TimelineRecord`, `Campaign`, `CaseRecord`, `RelationshipParticipant`, and `RelationshipSignal`. Migrations are intentionally not generated. CRUD routes/controllers remain explicitly out of scope.

## S2 Contract Boundary

Repository and service contracts are business-use-case contracts, not CRUD contracts.

Forbidden public contract methods include `save`, `create`, `update`, `delete`, `remove`, `persist`, `flush`, `index`, and `read`.

Use Relating lifecycle language instead: `rememberStarted`, `rememberCaptured`, `rememberQualified`, `rememberOpened`, `rememberStageChanged`, `recordBusinessActivity`, `projectBusinessEvent`, `ingestNeighborSignal`, `scoreRelationshipHealth`, and `suggestNextActionsForRelationship`.

## S3 ViewObject/API contract correction

This skeleton now includes a stable ViewObject/API boundary:

- `RelatingViewInterface` is the public output contract.
- `AbstractArrayView` rejects arbitrary object payloads to prevent entity leakage.
- `RelatingViewSurface` enumerates business surfaces.
- View builders return `RelatingViewInterface`, not Doctrine entities.
- View surfaces remain business-oriented and do not recreate CRUD list/detail routes.

CRUD remains outside Relating. Relating only exposes business surfaces such as relationship profile, timeline, lead conversion, opportunity board, campaign performance, case queue and AI suggestion review.

## S4 neighbor reference boundary

Relating integrates with neighboring components through scalar references, normalized signals, business messages, and view projections only. It does not recreate Vendor, Access, Product, Order, Payment, Shipment, Message, Project, Document, Membership, Contribution, or Event ownership.

Added S4 contracts:

```text
NeighborComponent
NeighborReferenceKind
NeighborReference
NeighborSignalEnvelope
NeighborReferenceCatalogInterface
NeighborSignalNormalizerInterface
NeighborSignalRouterInterface
RelationshipNeighborResolverInterface
```

CRUD route/controller ownership remains outside Relating.

## S5 demo seed and test readiness

The skeleton now includes business-lifecycle demo scenarios without CRUD semantics:

```text
relationship-start
lead-capture
lead-qualification
lead-conversion
opportunity-open
opportunity-stage-transition
timeline-projection
ai-review
```

Added S5 files:

```text
src/Enum/DemoScenarioKind.php
src/DataFixtures/RelatingDemoScenario.php
src/DataFixtures/RelatingDemoSeed.php
src/Factory/RelatingDemoEntityFactory.php
src/Snapshot/View/DemoScenarioView.php
tests/RelatingDemoSeedBoundaryTest.php
docs/demo-seed-readiness.md
docs/fixture-scenario-catalog.md
docs/business-lifecycle-demo-flow.md
docs/test-readiness-matrix.md
```

Demo scenarios use only business operation names such as `start_relationship`, `capture_lead`, `qualify_lead`, `convert_lead`, `open_opportunity`, `change_stage`, `project_timeline_event`, and `review_ai_suggestion`.

Forbidden demo operation names remain: `index`, `create`, `read`, `update`, `delete`, `list`, `show`, and `edit`.

## S6 Application Service Skeleton

S6 adds business application services for relationship-start, lead-capture, lead-qualification, lead-conversion, opportunity-open, opportunity-stage-transition, activity-record, timeline-project, and ai-review.

The application layer is command/result based and remains business-only. It does not introduce CRUD routes, CRUD controllers, generic entity lifecycle actions, migrations, or direct SQL.

`CreateAiSuggestionMessage` was replaced by `RaiseAiSuggestionMessage` to keep async messages business-named.



## S7 Business Route Handlers

Relating now includes a thin Symfony business route handler skeleton. These handlers map JSON payloads into application commands and call business application services.

Approved routes:

```text
GET  /relating/catalog
POST /relating/relationship/start
POST /relating/lead/capture
POST /relating/lead/qualify
POST /relating/lead/convert
POST /relating/opportunity/open
POST /relating/opportunity/stage/transition
POST /relating/activity/record
POST /relating/timeline/project
POST /relating/ai/suggestion/review
```

CRUD routes remain forbidden. Relating must not declare index/create/read/update/delete/list/show/edit/store/patch/remove route surfaces.

## S7 Business Route Handler Skeleton

S7 adds business HTTP handlers for approved Relating operations only. The route surface remains business-only and does not introduce CRUD controllers, CRUD YAML declarations, or index/create/read/update/delete/list/show/edit operations.

## S8 Symfony wiring skeleton

S8 adds Symfony wiring drafts for services, Messenger routing and workflow placeholders. Active host import remains explicit: `.dist` files must be reviewed before being copied/imported into the real app config.

Added files:

```text
config/services/relating.yaml.dist
config/packages/relating_messenger.yaml.dist
config/packages/relating_workflow.yaml.dist
config/relating_wiring.yaml.dist
docs/symfony-wiring-skeleton.md
docs/messenger-routing-draft.md
docs/route-import-notes.md
docs/config-boundary-checklist.md
docs/s8-wiring-report.md
tests/RelatingConfigBoundaryTest.php
tests/RelatingMessengerRoutingBoundaryTest.php
```

`CreateAiSuggestionMessage` is removed. AI suggestion lifecycle uses `RaiseAiSuggestionMessage`, `ReviewAiSuggestionMessage`, and `ApplyAiSuggestionMessage`.

The hard boundary remains unchanged: no CRUD routes, no CRUD controllers, no CRUD YAML, no migrations, no direct SQL, and no neighbor ownership.


## S9 Message handler skeleton

Relating includes Symfony Messenger handler skeletons for approved business messages only. These handlers call application services or business service contracts and must not become CRUD/persistence shortcuts.

Approved async surfaces include lead qualification/conversion, duplicate detection, scoring, opportunity transition, timeline build, SLA/risk/forecast recalculation, campaign performance, automation, and AI suggestion lifecycle.


## Wave History

- S10: Read model / projector skeleton for timeline, forecast, risk, campaign performance, SLA, and relationship health projections.

## S11 validation / policy boundary

Relating validates only approved business lifecycle actions.

```text
relationship.start
lead.capture
lead.qualify
lead.convert
opportunity.open
opportunity.stage_transition
activity.record
timeline.project
ai_suggestion.review
```

Validation and policy contracts must not introduce CRUD route semantics, CRUD controller semantics, direct SQL, migrations, or neighbor ownership. Access rules stay owned by Accessing; Relating may only consume access decisions and keep business decision traces.

## S12 audit / decision trace boundary

Relating records business decision traces only. It does not create CRUD audit routes, audit-table SQL, CRUD controllers, or migration-owned audit storage.

Trace surfaces:

```text
BusinessDecisionTrace
PolicyDecisionTrace
AiReviewTrace
TransitionTrace
NeighborSignalTrace
```

The trace layer explains lifecycle decisions such as lead qualification, lead conversion, opportunity stage transition, AI review, and neighbor signal acceptance.

## S13 documentation finalization

S13 adds a coherent documentation entrypoint and ADR pack for future Relating work.

Start here:

```text
README.md
docs/docs-entrypoint.md
docs/documentation-finalization-pack.md
docs/relating-canon.md
docs/boundary-adr-index.md
docs/implementation-roadmap-final.md
```

Hard rule preserved: Relating exposes only business routes and never recreates CRUD controllers, CRUD YAML, CRUD routes, or CRUD action surfaces.

## Wave S14 package/install readiness

Added package and install readiness documentation plus a local validation script:

```text
docs/package-install-readiness.md
docs/composer-autoload-notes.md
docs/symfony-import-checklist.md
docs/local-install-validation.md
docs/host-app-integration-checklist.md
docs/no-bundle-magic-boundary.md
docs/s14-package-install-report.md
tools/validate-relating-package.ps1
tests/RelatingPackageInstallBoundaryTest.php
```

S14 keeps the same hard boundaries: no CRUD route ownership, no CRUD controllers, no Bundle magic, no migrations in the skeleton, no direct SQL files, no `src/Domain`, and no custom namespace outside `App\`.

## Wave S15 release packaging quality

S15 adds release packaging discipline for cumulative archive delivery:

```text
docs/release-packaging-quality.md
docs/archive-hash-verification.md
docs/manifest-verification.md
docs/windows-install-notes.md
docs/inventory-discipline.md
docs/release-checklist.md
docs/s15-release-packaging-report.md
tools/verify-relating-manifest.ps1
tools/verify-relating-archive.ps1
tests/RelatingReleasePackagingBoundaryTest.php
```

Validation helpers:

```powershell
.\tools\validate-relating-package.ps1 -Root .
.\tools\verify-relating-manifest.ps1 -Root .
.\tools\verify-relating-archive.ps1 -ArchivePath .\relating-relationship-skeleton.zip -HashPath .\relating-relationship-skeleton.zip.sha256
```

S15 keeps the same hard boundaries: no CRUD route ownership, no CRUD controllers, no CRUD YAML, no migrations, no SQL files, no Bundle magic, no `src/Domain`, and no custom namespace outside `App\`.


## Wave S16 final skeleton gap review

S16 prepares the cumulative archive as a pre-install release candidate.

Added:

```text
docs/final-gap-review.md
docs/naming-cleanup-report.md
docs/obsolete-term-scan.md
docs/duplicate-concept-review.md
docs/docs-link-integrity.md
docs/preinstall-rc-checklist.md
docs/s16-final-gap-review-report.md
tools/validate-relating-final-gap.ps1
tests/RelatingFinalGapBoundaryTest.php
```

Cleanup applied:

```text
RelationshipParticipantRemoved -> RelationshipParticipantDetached
mass_update -> bulk_review
Create commercial intent -> Open commercial intent
```

S16 keeps the same hard boundaries: no CRUD route ownership, no CRUD controllers, no CRUD YAML, no migrations, no SQL files, no Bundle magic, no `src/Domain`, no neighbor ownership, and no custom namespace outside `App\`.


## Pre-install RC freeze

```text
Version: 0.1.0-rc.1
Status: frozen for first extraction
```

After `0.1.0-rc.1`, do not add more skeleton feature scope before the archive is extracted and validated in the local repository.

Allowed before extraction: packaging, manifest, hash, syntax, and install-script fixes.

Not allowed before extraction: new feature objects, CRUD routes, CRUD controllers, CRUD YAML declarations, migrations, SQL files, Bundle layer, `/src/Domain`, or neighbor ownership transfer.

See:

```text
docs/preinstall-rc-freeze.md
docs/rc-immutability-checklist.md
docs/first-extraction-flow.md
RELEASE_NOTES.md
```
