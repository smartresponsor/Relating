# S11 Report: Validation / Policy Skeleton

S11 adds business validation and policy contracts.

## Added code

```text
src/Relating/Validation/*
src/Relating/Policy/*
src/Relating/Enum/PolicyDecision.php
src/Relating/Enum/PolicyFailureCode.php
src/Relating/Enum/ValidationSeverity.php
src/Relating/Enum/PayloadFieldType.php
src/Relating/Enum/TransitionGuardOutcome.php
src/Relating/Service/RelatingPolicyRegistryInterface.php
src/Relating/Service/RelatingValidationSchemaRegistryInterface.php
```

## Added tests

```text
tests/Relating/RelatingValidationPolicyBoundaryTest.php
```

## Boundary

```text
No CRUD routes
No CRUD controllers
No CRUD YAML
No CRUD application actions
No direct SQL
No migrations
No neighbor ownership
No access-rule ownership
```
