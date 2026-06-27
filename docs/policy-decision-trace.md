# Policy Decision Trace

Policy trace is the bridge between validation/policy guards and business execution.

Relating does not silently reject business actions. The expected flow is:

```text
validate payload
resolve references
run business policy
record PolicyDecisionTrace
continue, reject, or require review
```

This is not a CRUD validation surface. It is attached only to business actions such as lead qualification, lead conversion, stage transition, AI review, and neighbor signal acceptance.
