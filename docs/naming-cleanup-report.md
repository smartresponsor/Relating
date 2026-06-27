# S16 Naming Cleanup Report

Relating naming must stay business-lifecycle oriented.

## Canonical names

| Surface | Canonical name |
| --- | --- |
| Market category | CRM |
| Symfony component | Relating |
| Root object | Relationship |
| Business party reference | VendorReference |
| AI lifecycle | raised, reviewed, applied |
| Participant lifecycle | attached, detached |
| Bulk business view | bulk_review |

## Removed or rejected names

| Rejected name | Replacement | Reason |
| --- | --- | --- |
| RelationshipParticipantRemoved | RelationshipParticipantDetached | Avoid CRUD-like remove semantics. |
| mass_update | bulk_review | Relating must not publish bulk mutation surfaces. |
| Create commercial intent | Open commercial intent | Opportunity lifecycle uses open/opened language. |
| Crm namespace | Relating | CRM remains market label only. |
| Account/Contact ownership | VendorReference | Vendoring owns the party identity. |

## Rule

When a source CRM uses CRUD or legacy module names, Relating keeps the business meaning and rewrites the implementation name into the Symfony canon.
