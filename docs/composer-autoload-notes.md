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
Allowed: AppBundle
Allowed: App\Relationship
Allowed: App\Entity\Relationship
Forbidden: AppBundle\RelatingBundle
Forbidden: App\Domain\Relating
Forbidden: Relating\Relationship
```

## Composer install position

`Relating` can now be used either as a source-level component under the host application or as a local Composer path package for standalone debugging:

```text
src
```

The first production repository may later add package metadata, but the code namespace must remain `App\\` while this component is developed inside the default Symfony app namespace.
