# RC Immutability Checklist

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

Use this checklist before replacing the current RC archive.

## Archive identity

```text
VERSION exists and contains 0.1.0-rc.1
RELEASE_NOTES.md exists
MANIFEST.json lists every packaged file
relating-relationship-skeleton.zip.sha256 matches the ZIP
```

## Symfony boundary

```text
Only App namespace
No src/Domain path
No Bundle classes
No migrations
No SQL files
No vendor or node_modules
```

## Route boundary

```text
Only business routes are allowed.
CRUD routes are not allowed.
CRUD controllers are not allowed.
CRUD YAML declarations are not allowed.
Generic actions such as index/list/show/store/edit/patch/remove are not allowed in route surface.
```

## Neighbor boundary

```text
Vendoring owns Vendor.
Accessing owns access/security rules.
Assessing owns assessment responsibility.
Managing owns backoffice/operation surfaces.
Producting/Production owns Product.
Ordering owns Order.
Payment owns Payment.
Shipment owns Shipment.
Messaging owns Message/Thread.
Projecting owns Project.
Relating stores references and normalized signals only.
```

## Work freeze

```text
No new feature scope before first extraction.
Only packaging/syntax/inventory/install fixes are allowed.
```
