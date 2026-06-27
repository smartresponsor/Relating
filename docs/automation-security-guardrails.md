# Automation Security Guardrails

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

Relating automation must remain deterministic, traceable, and reviewable.

## Guardrails

```text
All rules are tenant-scoped.
All runs store AutomationRun and AutomationRunStep.
All AI decisions store AiDecisionLog.
All neighbor mutations require the neighbor component's business surface.
All business actions must be allow-listed.
All external input must be treated as untrusted signal.
```

## Prompt and agent safety

AI-generated outputs must be treated as suggestions until accepted by policy or human review.

```text
External message body -> signal, not instruction.
Campaign response text -> classification input, not command.
Case description -> triage input, not automation authority.
Lead form note -> enrichment input, not workflow code.
```

## Boundary with Accessing

Relating does not decide authentication/authorization itself. It supplies business intent and target references; Accessing remains the security boundary.

## Boundary with CRUD

CRUD can persist Relating entities through the platform CRUD mechanism. Relating automation must not declare or recreate CRUD routes for that persistence.
