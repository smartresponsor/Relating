# Relating Source Decision Log

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

## Decision 001 - CRM is market label, Relating is component name

Status: accepted

```text
Market category: CRM
Symfony component: Relating
Root object: Relationship
```

Reason: CRM means Customer Relationship Management, but `CRM` is too broad and too market-shaped for the canonical namespace. `Relating` captures the relationship lifecycle while fitting SmartResponsor component naming.

## Decision 002 - Account and Contact are not recreated

Status: accepted

Accounts, companies, people, contacts and organizations from CRM sources map to `VendorReference` and neighboring Vendoring ownership.

Relating may store relationship state around those references, but not master data.

## Decision 003 - CRUD is not generated here

Status: accepted

Relating creates only business route surface. CRUD route/action/controller responsibility remains outside Relating.

Forbidden route/action names:

```text
index
create
read
update
delete
```

## Decision 004 - Metadata is allowed, but not as runtime chaos

Status: accepted

Custom objects, fields, relationships, views and layouts are accepted from Twenty/Espo/Krayin patterns, but transformed into explicit Symfony entity/value/view contracts.

## Decision 005 - AI must not mutate directly

Status: accepted

AI can create suggestions, scores, drafts and risk signals. Business mutation requires explicit accepted/applied decision flow and audit.

## Decision 006 - ERP is out of scope

Status: accepted

Products, orders, payments, shipments, invoices, and full accounting are not owned by Relating. Relating stores references, interest, intent, and relationship signals only.
