# CMCP Execution Journal

## 2026-09-13 — Relating RC hardening

### Baseline
- Read Relating README, MANIFEST, Composer/Symfony config, source boundaries, tests, package/install docs and S19 runtime docs.
- Read current Canonization normative rules and Gating mirrors relevant to dependency, dual-runtime, tooling and testing contracts.
- Read Objecting, Cruding, Viewing and Interfacing README/composer/AGENTS/manifests where present; verified Collectioning and Tabling package identities.
- Business-route scan found lifecycle/business actions only; no generic CRUD route surface.
- Baseline: Composer strict validation passed; PHPUnit passed 74 tests / 25,312 assertions; PHP-CS-Fixer check exposed formatting debt.

### Canon mapping
- Canon022 applies because `bin/console` and `config/bundles.php` exist: declare the complete direct platform baseline.
- Canon023/043: locally linked first-party packages use sibling path repositories, symlink=true and exact dev-master.
- Canon024: production Composer manifest is path-independent.
- Canon025/032: the existing `App\Relating\RelatingBundle` is registered by standalone mode.
- Canon029: PHP-CS-Fixer and PHPStan are repository-owned and reproducibly executable.
- Canon039: PHPUnit configuration declares the production source population and persistent branch coverage path.
- Canon041: Symfony Test Pack, Panther and repository-local Playwright tooling are present.
- Canon018 is authoritative: `relating/relation` maps component identity to `App\\Relating\\` and component-owned PHP subject vocabulary to `Relation*`.

### RC-critical workstream
- Close dependency, production-manifest, bundle-registration, static-analysis, formatting and multi-layer test-tooling gaps.
- Re-resolve dependencies, run Gating, Composer validation/audit, PHPStan, PHPUnit, coverage, Symfony lints and Playwright tooling, then repair factual in-scope failures.
- Preserve zero generic CRUD ownership in Relating.

### Growth workstream
- After RC, improve configurable relationship views/workflows, qualification/forecasting UX/API contracts, AI-assisted actions and observability without moving CRUD, shell rendering, navigation discovery or Objecting field-pack ownership into Relating.

### Material risks
- Legacy package-install/no-bundle documentation conflicts with the current dual-runtime canon and requires correction.
- `AbstractRelatingEntity` has local lifecycle and tenant-reference state; Objecting requires semantic/data-safe classification before migration, so no mechanical rewrite is permitted.
- Pre-existing untracked `.gating/` and `var/` are not product-source changes and must not be committed.

### Gates
- Composer validate/resolution/audit.
- Gating.
- PHP syntax, PHPStan and PHP-CS-Fixer.
- PHPUnit and coverage.
- Symfony container/YAML checks.
- npm/Playwright checks.
- Final Git/worktree/upstream inspection.

### RC implementation result
- Canonicalized the source tree to technical-role-first Symfony roots and removed the competing `Application`, `MessageHandler`, `ReadModel`, `Validation`, `View`, `Value`, `Trace`, `Debug`, and `Fixture` top-level taxonomies.
- Historical note corrected 2026-09-20: treating default `App\\` as an owner override was erroneous; Canon018 requires `App\\Relating\\` / `Relation*`.
- Added canonical first-party dependency wiring, production Composer manifest, standalone bundle registration, PHPStan/PHPUnit/Panther/Playwright tooling, and path-independent production packaging.
- Restored business-only routing under `config/routes/relation_routes.yaml`; generic CRUD remains owned by Cruding.
- Replaced committed literal framework secret material with `%env(APP_SECRET)%`, untracked generated `config/reference.php`, and hardened the local archive installer against broad recursive-force deletion.
- Added executable Doctrine metadata parity verification using the underscore naming strategy while preserving host-owned database/migration responsibility.

### Verified gates
- PHPUnit: 74 tests / 25,676 assertions green.
- PHPUnit path coverage under Xdebug 3.5.1: 74 tests / 25,676 assertions green; `var/coverage/summary.txt` generated.
- PHPStan level 8: green with an explicit baseline of 194 legacy findings; new findings remain blocking.
- Doctrine parity: 79 mapped entities / 118 generated schema statements green; component-local migrations absent.
- npm/Playwright tooling: green (`playwright test --pass-with-no-tests`).
- Historical verification at this point still had Canon018 unresolved; the later identity migration supersedes the former default-`App\\` interpretation. Non-blocking maturity warnings remained for PHPDoc, PHP test, and behavioral/UI coverage.

### Residual growth debt
- Burn down the PHPStan baseline instead of regenerating it casually.
- Raise semantic PHPDoc coverage from the current legacy baseline.
- Add real browser/UI behavioral scenarios before claiming UI coverage; absence of those scenarios does not block this business/API-oriented RC.

## 2026-09-20 — RC dependency pinning follow-up

### Reconnaissance and market baseline
- Re-read Relating responsibility, package/runtime manifests, business route boundary, release/roadmap docs, current Git state, and the Objecting/Cruding/Viewing/Interfacing plus Canonization/Gating contract contour.
- CRM market/open-source baseline remains lifecycle-centric: relationship/lead/opportunity/activity/timeline/campaign/case automation, explicit business transitions, stable integration boundaries, auditability, projections, and testable APIs. Generic CRUD, shared shell rendering, access ownership, transport storage, and cross-component system fields stay outside Relating.
- RC-critical work selected: repair the deterministic Canon043 development dependency identity failure without changing Relating business behavior.
- Growth work remains separate: deeper workflow/forecasting/AI assistance, observability, real behavioral scenarios, and coverage improvement after RC.

### Canonization mapping consulted
- Canon018: authoritative identity is `App\\Relating\\` with `Relation*`; the earlier default-`App\\` exception interpretation was incorrect and is superseded.
- Canon019/020: role-first source topology applies; current Gating evidence passes.
- Canon021: generic CRUD stays in Cruding; current business-only route surface passes.
- Canon022/023/024/025/026: standalone baseline, local symlink development, packaged production, dual runtime, and PHP/Symfony baseline apply and pass.
- Canon029/030: repository quality tooling and executable Doctrine parity contract apply and pass.
- Canon040: coverage remains measurable debt, including HIGH_TEST_DEBT, but is not the deterministic RC failure repaired in this follow-up.
- Canon043 (current Gating identity: `development_composer_dependency_version`): each sibling path repository must pin `options.versions[package]` to exact `dev-master`; applied to Cruding, Collectioning, Tabling, Viewing, Interfacing, and Objecting.

### Material risk and boundary decisions
- `AbstractRelatingEntity` still contains local `tenantReference`, `createdAt`, and `updatedAt`; Objecting requires semantic/data-safe classification before any system-field migration. No mechanical migration is performed in this follow-up.
- No CRUD, navigation, presentation ownership, or neighbor master-data ownership is added.

### Verification target
- Re-run Gating, Composer validation-compatible checks, PHP-CS-Fixer, PHPStan, PHPUnit, Doctrine parity, and final Git state; repair only factual Relating-owned failures.

### Follow-up result
- Canon043 is now green; all six direct sibling path repositories pin their package identity to `dev-master` while retaining `symlink: true`.
- Composer lock was refreshed against current sibling heads and maintained dependencies; strict Composer validation is green and Composer reported no security advisories.
- PHP-CS-Fixer check: 575 files, zero fixes required.
- PHPStan level 8 with the existing legacy baseline: green.
- PHPUnit after dependency refresh: 74 tests / 26,261 assertions green.
- Doctrine parity: 79 mapped entities / 118 generated schema statements green; host-owned migrations boundary preserved.
- Historical result: Canon018 was then the remaining hard failure. The claimed default-`App\\` exception was incorrect; the subsequent identity migration applies Canon018. Warnings remain for PHPDoc coverage, HIGH_TEST_DEBT, and behavioral/UI evidence.

## 2026-09-23 — Relating RC canon closure

### Baseline and reconnaissance
- Workspace: `D:\\PhpstormProjects\\www\\Relating`, branch `master`.
- Pre-existing dirty state before this run: `.gating/README.md`, `composer.json`, `composer.lock`, and `composer.prod.json`. Those files were inspected before any write; the Composer changes are the in-progress Canon052 Gating integration and are preserved.
- Read Relating README, Composer manifests, Symfony configuration, documentation entrypoint/canon/ADR/roadmap, representative source/repository/service contracts, tests, and the repository inventory returned by RC diagnostics.
- Read mandatory Objecting, Cruding, Viewing, Interfacing, Gating, and Canonization contract surfaces available in the shared workspace. Canonization was treated as read-only normative material.
- Market/OSS benchmark: Twenty models CRM around objects, relations, views, workflows and AI; SuiteCRM models relationships/subpanels plus workflow automation. These validate Relating's lifecycle/relationship boundary while generic CRUD, shell rendering, access ownership and transport remain outside this component.

### Canonization mapping consulted
- Canon004: every terminal Doctrine persistence class under `src/Entity/` must use the `Entity` suffix. Relating still has flat mapped entity classes with unsuffixed terminal names.
- Canon007/018: entity renames must preserve literal file/class/namespace identity and the `App\\Relating\\` / `Relation*` component identity.
- Canon008/022/026/032: current direct platform dependencies, Symfony 8.1/PHP 8.4 baseline and dual standalone/bundle runtime remain applicable.
- Canon021: generic CRUD remains owned by Cruding; Relating keeps business-action routes only.
- Canon044/054: Objecting system fields and Doctrine physical identifiers stay entity-native/lower_snake_case; this pass changes PHP persistence type identity, not physical schema ownership.
- Canon047: direct `EntityManagerInterface` access belongs under `src/Repository/`; `RelationVendorLeadReadService` must consume a repository contract instead.
- Canon052: consumer `.gating/` is artifact-only; executable/normative Gating copies must be removed while Composer-based Gating integration remains.
- Canon053: Relating's development sibling symlinks are limited to the explicit canonical helper/foundation exceptions currently used by the component.

### RC-critical workstream
1. Rename mapped Relating persistence types and files to the required `*Entity` terminal identity, updating all first-party references atomically.
2. Move vendor-lead Doctrine querying behind `RelationLeadRepositoryInterface` and keep the service persistence-agnostic.
3. Remove tracked executable/normative Gating copies from consumer `.gating/`, retaining only the artifact-boundary README and generated/untracked evidence.
4. Re-run Composer validation, Gating, PHP-CS-Fixer, PHPStan, PHPUnit, Doctrine parity, coverage/tooling checks, and inspect final Git/upstream state.

### Growth workstream
- Post-RC: configurable relationship views/workflows, richer forecasting and AI-assisted actions, observability/diagnostics, and real behavioral/UI coverage. None may absorb Cruding, Viewing, Interfacing, Accessing, transport or Objecting ownership.

### Implementation result
- Canon004 closed by renaming 77 mapped Doctrine persistence types/files to the terminal `*Entity` identity and updating PHP/config references without changing Doctrine physical table/column names.
- Canon047 closed by moving vendor-lead lookup behind `RelationLeadRepositoryInterface::leadsForRelationship()`; `RelationVendorLeadReadService` no longer depends on Doctrine's entity manager.
- Canon052 closed by restoring consumer `.gating/` to artifact-only state and using the Composer-installed `gating/gate` binary. The pre-existing Composer/Gating integration changes were retained and verified rather than overwritten.
- PHPStan baseline references were migrated to the renamed entity identities only; three now-resolved debug-repository suppressions were removed rather than replaced with new suppressions.
- The temporary entity-migration codemod was deleted after use; no migration helper remains in product tooling.

### Verification result
- Composer validate strict/check-lock: PASS.
- Composer audit: PASS, no security advisories.
- Composer install: `gating/gate` installed from the sibling path package and `vendor/bin/gating` materialized.
- PHP lint changed files: PASS.
- PHP-CS-Fixer dry-run: PASS (575 files, zero fixes).
- PHPStan level 8 with existing legacy baseline: PASS, zero new errors.
- PHPUnit: PASS, 74 tests; final aggregate quality run recorded 28,092 assertions.
- PHPUnit Xdebug path/branch coverage: PASS; current evidence is 46.5% lines (859/1846), 22.8% methods (132/578), 50.1% branches (383/764).
- Doctrine parity: PASS, 79 mapped entities / 118 generated schema statements; host-owned migrations boundary preserved.
- npm/Playwright tooling: PASS with no browser scenarios currently present.
- Gating: PASS, 70 rules / 0 failed / 3 warnings / 15 skipped.
- Composer `quality`: PASS through canonical `vendor/bin/gating`.

### Residual non-blocking maturity debt
- Canon031 PHPDoc coverage is below the 70% target and remains a large semantic documentation workstream.
- Canon040 reports HIGH_TEST_DEBT against the coverage targets (80% lines/methods, 70% branches); the coverage evidence is current, not stale.
- Canon042 remains a warning because Relating has no behavioral/UI scenarios or repository producer for `var/coverage/behavioral-ui.json`; no synthetic evidence was created.
- These warnings are post-RC growth/hardening work and were not suppressed or misrepresented as passing coverage.

