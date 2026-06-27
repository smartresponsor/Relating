# Payload Validation Contract

HTTP business handlers receive arrays. Application services receive typed command objects.

The boundary is:

```text
HTTP payload -> BusinessPayloadValidatorInterface -> Command -> BusinessCommandValidatorInterface -> Application Service
```

## Payload schema

`PayloadSchema` and `PayloadFieldRule` define business-action input expectations without tying the component to a UI form or CRUD resource.

## Required payload types

```text
string
integer
boolean
decimal
datetime
array
object
enum
reference
```

## Forbidden surface

The validation layer must not introduce:

```text
crud.index
crud.show
crud.create
crud.update
crud.delete
crud.list
crud.edit
crud.patch
crud.remove
```
