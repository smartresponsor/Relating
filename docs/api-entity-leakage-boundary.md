# API entity leakage boundary

Relating API/business routes must not expose Doctrine entities.

## Allowed

- `RelatingViewInterface`
- scalar arrays produced by a view payload normalizer
- reference arrays such as `vendorReference`, `orderReference`, `messageThreadReference`
- business status values and enum string values

## Forbidden

- returning `App\Entity\*` from controllers
- returning Doctrine entities from view builders
- passing entity objects into `AbstractArrayView` payloads
- using Entity objects as public API response schemas
- creating CRUD route outputs from entities

## Reason

The Relating surface is a business relationship lifecycle boundary. CRUD is handled by the existing SmartResponsor CRUD mechanism, while Relating owns business actions, timelines, transitions, scoring, conversion and review views.
