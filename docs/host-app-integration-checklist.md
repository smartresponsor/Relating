# Host Application Integration Checklist

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

This checklist is used after the skeleton has been unpacked and validated.

## Integration order

```text
1. Validate package integrity.
2. Check namespace and path canon.
3. Review business route import.
4. Review service .dist templates.
5. Review Messenger .dist routing.
6. Review Workflow .dist templates.
7. Align Doctrine mapping in the host app and use Doctrine's underscore/snake_case naming strategy expected by Relating index metadata.
8. Run `composer schema:parity`, then generate host-owned migrations only after mapping review.
9. Run PHPUnit boundary tests.
10. Connect neighboring components through references/signals only.
```

## Neighbor integration

`Relating` may reference:

```text
Vendoring
Accessing
Assessing
Managing
Producting
Production
Ordering
Payment
Shipment
Messaging
Projecting
Documentating
Media
Viewing
```

`Relating` must not own their entities, tables, routes, or CRUD behavior.

## Route ownership

The host app keeps CRUD route ownership outside `Relating`. This skeleton only contributes business lifecycle routes.

## Failure rule

If an integration step tries to introduce CRUD route ownership, Bundle magic, SQL-first migrations, or neighbor entity ownership into `Relating`, reject the step and update documentation before code proceeds.
