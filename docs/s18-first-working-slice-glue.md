# S18 First Working Slice Glue

This wave turns the frozen Relating skeleton into the first runnable business slice.

It does not add new CRM object families. It only wires concrete infrastructure behind the contracts that already existed in the skeleton.

## Included concrete infrastructure

```text
DoctrineRelationshipRepository
DoctrineLeadRepository
DoctrineOpportunityRepository
UuidRelatingIdGenerator
DispatchingRelatingBusinessEventRecorder
config/services/relating_first_slice.yaml.dist
```

## Runnable business flow

```text
relationship.start
lead.capture
lead.qualify
lead.convert
opportunity.open through lead conversion
```

The route surface stays unchanged:

```text
POST /relating/relationship/start
POST /relating/lead/capture
POST /relating/lead/qualify
POST /relating/lead/convert
```

## Boundary

```text
No CRUD routes.
No CRUD controllers.
No CRUD YAML declarations.
No migrations in this wave.
No direct SQL files.
No Symfony Bundle layer.
No /src/Domain path.
No neighbor ownership transfer.
```

## Host import

Copy or import the opt-in wiring after package validation:

```yaml
imports:
    - { resource: services/relating.yaml }
    - { resource: services/relating_first_slice.yaml }
```

The host application remains responsible for Doctrine migration generation after reviewing the EntityFirst mapping.

## Next validation

```powershell
php -l .\src\Relating\Repository\DoctrineRelationshipRepository.php
php -l .\src\Relating\Repository\DoctrineLeadRepository.php
php -l .\src\Relating\Repository\DoctrineOpportunityRepository.php
php -l .\src\Relating\Service\UuidRelatingIdGenerator.php
php -l .\src\Relating\Service\DispatchingRelatingBusinessEventRecorder.php
```

After lint passes, run the host Symfony container check from the application repository that imports these files.
