# Business Route Request Contract

Every Relating business route accepts a JSON object and maps it into an application command. The controller is intentionally thin:

1. parse request JSON;
2. validate required scalar fields;
3. instantiate the business command;
4. call the matching application service;
5. return a normalized business result payload.

The controller must not fetch Doctrine entities, build SQL queries, or perform CRUD-style persistence.

## Standard response

```json
{
  "component": "Relating",
  "business_action": "lead-capture",
  "subject_reference": "lead_...",
  "payload": {}
}
```

## Neighbor references

Neighbor objects are passed as scalar references only: `vendor_reference`, `product_reference`, `order_reference`, `payment_reference`, `shipment_reference`, `message_thread_reference`, `project_reference`, `access_subject_reference`. Relating must not instantiate neighbor entities.
