# Relating Anti-Pattern Rejection Catalog

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

## Hard rejections

```text
No CRUD controller generation.
No CRUD YAML route declarations.
No index/create/read/update/delete action names.
No Account/Contact master-data duplication.
No SQL-first design.
No Doctrine entity exposure as API contract.
No unbounded dynamic object storage that bypasses EntityFirst rules.
No workflow that mutates arbitrary records without explicit service/event/audit.
No AI action that writes directly without suggestion and decision log.
No Accessing security duplication.
No Product/Order/Payment/Shipment ownership inside Relating.
```

## Legacy transformation rules

| Legacy pattern | Relating transformation |
|---|---|
| Account table | VendorReference + Relationship |
| Contact table | VendorReference + RelationshipParticipant |
| Dynamic module CRUD | ObjectDefinition + ViewObject + existing CRUD mechanism |
| Workflow writes any module | AutomationRule + specific Symfony service + audit |
| SQL report | ReadModel/ViewObject/query service |
| Email module | MessageThreadReference + TimelineEvent |
| Product/invoice/contract suite | ProductReference / OrderReference / PaymentReference / CommercialTerm |
| Role/security config | Accessing reference and voters/policies later |

## Review checklist per imported idea

```text
1. Who owns the master data?
2. Is this relationship lifecycle or neighbor responsibility?
3. Is there a ViewObject contract?
4. Is there a business event/message?
5. Is it CRUD or business behavior?
6. Is the route business-only?
7. Is there audit for state-changing action?
8. Does AI suggest rather than mutate?
9. Can Doctrine model it EntityFirst?
10. Does the name fit Relating/Relationship canon?
```
