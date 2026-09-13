# Test readiness matrix

## Boundary tests

| Test | Purpose |
| --- | --- |
| `RelatingRouteBoundaryTest` | Prevent CRUD routes/controllers/YAML declarations. |
| `RelatingEventBoundaryTest` | Prevent CRUD-style lifecycle events. |
| `RelatingContractBoundaryTest` | Prevent CRUD-style Repository/Service contracts. |
| `RelatingViewBoundaryTest` | Prevent Doctrine Entity leakage in View/API payloads. |
| `RelatingNeighborBoundaryTest` | Prevent neighbor entity ownership leaks. |
| `RelatingDemoSeedBoundaryTest` | Prevent CRUD-style demo scenario operations. |

## Demo factory smoke coverage

| Factory method | Objects |
| --- | --- |
| `relationshipStart()` | `Relationship`, `TimelineRecord`, `Activity` |
| `qualifiedLead()` | `Lead`, `TimelineRecord` |
| `opportunityFlow()` | `Pipeline`, `PipelineStage`, `Opportunity`, `TimelineRecord` |

## Next test waves

- application service tests for relationship start
- lead qualification tests
- lead conversion tests
- opportunity transition tests
- timeline projection tests
- AI suggestion review tests
- neighbor signal normalization tests
