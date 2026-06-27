# Composer Autoload Notes

Copyright (c) 2025 Oleksandr Tishchenko / Marketing America Corp

`Relating` uses the default Symfony application namespace only:

```json
{
  "autoload": {
    "psr-4": {
      "App\\": "src/"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "App\\Tests\\": "tests/"
    }
  }
}
```

The component does not require a custom namespace such as `Relating\\`, `SmartResponsor\\Relating\\`, or `Domain\\`.

## Package rule

S19 allows one explicit optional Symfony Bundle wrapper:

```text
Allowed: App\Relating\RelatingBundle
Allowed: App\Relating\Relationship
Allowed: App\Relating\Entity\Relationship
Forbidden: App\RelatingBundle\RelatingBundle
Forbidden: App\Domain\Relating
Forbidden: Relating\Relationship
```

## Composer install position

`Relating` can now be used either as a source-level component under the host application or as a local Composer path package for standalone debugging:

```text
src/Relating
```

The first production repository may later add package metadata, but the code namespace must remain `App\\Relating` while this component is developed inside the default Symfony app namespace.
