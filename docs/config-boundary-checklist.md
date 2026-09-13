# Config boundary checklist

Before importing Relating config into a Symfony host application, check:

```text
1. config/routes/relation_routes.yaml contains only the business controller import.
2. config/services/relating.yaml.dist excludes Entity, Enum, Value, View, Message, Event, Command and Result folders.
3. config/packages/relating_messenger.yaml.dist routes only business messages.
4. No config file contains CRUD route declarations.
5. No config file creates Doctrine migrations.
6. No config file registers SQL-first repositories or raw DBAL query services.
7. No neighbor component ownership is imported into Relating.
```

The active host app may copy `.dist` files to real YAML only after reviewing
transport, route and service policy.
