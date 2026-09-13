# Relating Implementation Roadmap Final

This roadmap converts the current skeleton into a working Relating component without violating the established boundaries.

## Stage 1: Host integration review

- Place skeleton into `D:\PhpstormProjects\www\Relating` or the selected repository.
- Run PHP syntax checks.
- Review service namespace and autoload.
- Review business route import, keeping CRUD routes absent.
- Review Doctrine mapping readiness without generating migrations yet.

## Stage 2: Entity and mapping hardening

- Review core entities and value objects.
- Add Doctrine mapping details only where entity invariants are stable.
- Generate host migration from EntityFirst model.
- Review generated migration manually.
- Avoid direct SQL unless a documented read-model exception is approved.

## Stage 3: Application service implementation

Implement business use cases:

- start relationship;
- capture lead;
- qualify lead;
- convert lead;
- open opportunity;
- transition opportunity stage;
- record activity;
- project timeline;
- review AI suggestion.

## Stage 4: Repository implementation

Implement repository contracts with business methods only:

- remember started relationship;
- remember captured/qualified/converted lead;
- remember opened opportunity;
- remember stage transition;
- remember recorded activity;
- remember projected timeline;
- remember reviewed suggestion.

Do not add CRUD repository methods to public contracts.

## Stage 5: Business route wiring

Activate only the approved business routes:

- `/relating/catalog`
- `/relating/relationship/start`
- `/relating/lead/capture`
- `/relating/lead/qualify`
- `/relating/lead/convert`
- `/relating/opportunity/open`
- `/relating/opportunity/stage/transition`
- `/relating/activity/record`
- `/relating/timeline/project`
- `/relating/ai/suggestion/review`

## Stage 6: Read models and projections

- Relationship timeline.
- Opportunity forecast.
- Opportunity risk.
- Campaign performance.
- Case SLA.
- Relationship health.

## Stage 7: Automation and AI

- Implement trigger matching.
- Implement condition evaluation.
- Implement action execution.
- Implement AI suggestion review flow.
- Ensure trace recording for every decision.

## Stage 8: Demo scenario verification

Run scenarios:

- relationship-start;
- lead-capture;
- lead-qualification;
- lead-conversion;
- opportunity-open;
- opportunity-stage-transition;
- timeline-projection;
- ai-review.

## Stage 9: Product hardening

- Add fixtures and demo seed stability.
- Add policy and validation coverage.
- Add Messenger handler tests.
- Add read-model projector tests.
- Add neighbor signal normalization tests.
- Add route boundary regression tests.

## Stage 10: Release candidate

- Prepare RC manifest.
- Run lint and test suite.
- Validate route boundary.
- Validate no CRUD route/controller/YAML leakage.
- Validate no neighbor ownership leakage.
- Validate no Doctrine entity leakage in ViewObjects.
