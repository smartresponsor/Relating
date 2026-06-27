# Relating Open-Source CRM Vacuum Plan

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This document defines how Relating learns from open-source CRM systems without importing their legacy architecture.

## Hard canon

Relating uses open-source CRM projects as business and product references only.

Relating must not copy foreign architecture, SQL-first design, fat controllers, module legacy, route conventions, table names, UI state conventions, or framework-specific patterns.

Relating keeps the SmartResponsor Symfony canon:

```text
Namespace: App
Component: Relating
Root object: Relationship
Market label: CRM
Path: src
Forbidden path: src/Domain
```

## Route boundary

Relating discovery must not generate CRUD scope.

```text
Do not create CRUD controllers.
Do not create CRUD YAML route declarations.
Do not create route attributes for CRUD actions.
Do not declare index/create/read/update/delete action routes.
Do not re-own CRUD behavior already owned by the SmartResponsor CRUD mechanism.
```

Relating may create only business route surface:

```text
qualify lead
convert lead
link vendor
unlink vendor
transition opportunity
build timeline
review duplicate
apply AI suggestion
run automation
score relationship
view object catalog
view dashboard/read-model
```

## Source priority

The vacuum order is:

```text
D1 Twenty     - modern objects, fields, views, workflows, agents
D2 EspoCRM    - entity manager, fields, relationships, layout manager
D3 SuiteCRM   - broad CRM module catalog and mature business flows
D4 OroCRM     - Symfony-near customer 360, sales, marketing, commerce-adjacent CRM
D5 Krayin     - SMB forms, attributes, pipeline, quotes, Laravel/PHP practical CRM
D6 CiviCRM    - nonprofit/community relationship depth, cases, campaigns, groups
D7 Anti-pattern review - what must not enter Relating
```

## What to extract

```text
Object catalog
Relationship graph
View catalog
Layout types
Business lifecycle states
Workflow triggers
Workflow actions
Permission surface
Duplicate and merge behavior
Import/export behavior
Reporting/dashboard surface
AI/automation review surface
```

## What to reject

```text
Account/contact ownership duplication
Direct SQL-first implementation
Legacy module inheritance
Global god services
Fat controllers
Frontend-only layout state
CRUD route declarations
Magic workflow without audit
AI mutation without review/audit
ERP/accounting ownership inside Relating
```

## Output artifacts per vacuum wave

Every source vacuum wave should output:

```text
1. source-object findings
2. Relating canonical object mapping
3. neighbor ownership mapping
4. view/layout mapping
5. lifecycle/workflow mapping
6. accepted additions
7. rejected patterns
8. skeleton patch candidates
```
