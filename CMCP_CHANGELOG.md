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
- Canon025/032: the existing `App\RelatingBundle` is registered by standalone mode.
- Canon029: PHP-CS-Fixer and PHPStan are repository-owned and reproducibly executable.
- Canon039: PHPUnit configuration declares the production source population and persistent branch coverage path.
- Canon041: Symfony Test Pack, Panther and repository-local Playwright tooling are present.
- Canon018 conflicts with the explicit owner/default-Symfony `App\` namespace policy; the owner policy is preserved and no alternative root namespace is introduced.

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
- Preserved the explicit owner requirement for the default `App\\` namespace. Canon018 still expects `App\\Relating\\` / `Relation*` naming and is therefore recorded as a canon-policy conflict rather than applied to this component.
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
- Gating: every applicable hard rule repaired; Canon018 remains the documented `App\\` namespace conflict. Non-blocking maturity warnings remain for PHPDoc coverage, PHP test coverage (46.6% lines / 22.9% methods / 50.3% branches), and absent real browser/UI behavioral coverage evidence.

### Residual growth debt
- Burn down the PHPStan baseline instead of regenerating it casually.
- Raise semantic PHPDoc coverage from the current legacy baseline.
- Add real browser/UI behavioral scenarios before claiming UI coverage; absence of those scenarios does not block this business/API-oriented RC.
