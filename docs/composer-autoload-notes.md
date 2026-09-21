# Composer Autoload Notes

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

`Relating` uses the Canon018 component namespace derived from `relating/relation`:

```json
{
  "autoload": {
    "psr-4": {
      "App\\Relating\\": "src/"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "App\\Relating\\Tests\\": "tests/"
    }
  }
}
```

The canonical component namespace is `App\\Relating\\`; `relation` is the canonical PHP subject prefix (`Relation*`).

## Package rule

S19 allows one explicit optional Symfony Bundle wrapper:

```text
Allowed: AppBundle
Allowed: App\Relationship
Allowed: App\Entity\Relationship
Forbidden: AppBundle\RelatingBundle
Forbidden: App\Domain\Relating
Forbidden: Relating\Relationship
```

## Composer install position

`Relating` can now be used either as a source-level component under the host application or as a local Composer path package for Symfony root debug execution:

```text
src
```

Development and production manifests must preserve the Canon018 identity: `App\\Relating\\ => src/` with `Relation*` component-owned PHP types.
