# S4 Neighbor Contract Report

This wave added explicit neighbor reference and signal contracts for Relating.

## Added code

```text
Enum/NeighborComponent
Enum/NeighborReferenceKind
Enum/NeighborSignalDirection
Enum/NeighborInteractionMode
Value/NeighborReference
Value/NeighborSignalEnvelope
Service/NeighborReferenceCatalogInterface
Service/NeighborSignalNormalizerInterface
Service/NeighborSignalRouterInterface
Service/RelationshipNeighborResolverInterface
View/NeighborReferenceView
```

## Added tests

```text
tests/Relating/RelatingNeighborBoundaryTest.php
```

## Boundary status

```text
CRUD boundary: unchanged and enforced
Neighbor ownership boundary: explicit
Reference-only integration: explicit
Signal normalization: explicit
Entity leakage: still forbidden in views
```
