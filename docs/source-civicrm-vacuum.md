# CiviCRM Vacuum Notes

## Purpose

CiviCRM is used as a relationship/nonprofit/community CRM reference. Relating does not copy CiviCRM's CMS integration model, schema, APIs, permission model, or component architecture.

## What CiviCRM contributes

CiviCRM is valuable because it treats CRM as a broader relationship system, not only as sales pipeline. Its contact screen exposes relationship-oriented tabs and histories such as relationships, activities, mailings, contributions, memberships, events, groups, notes, tags, and change log.

For SmartResponsor this is important because Relating should support sales, vendor/customer relationship lifecycle, nonprofit/community relationship memory, case workflows, and donor/member/event references without becoming ERP or accounting.

## Canonical mapping

| CiviCRM source surface | Relating canonical target | Owner |
|---|---|---|
| Contact | VendorReference | Vendoring |
| Contact relationship | RelationshipRelation / RelationshipParticipant | Relating |
| Activities tab | Activity / TimelineEvent | Relating |
| Mailings tab | CampaignTouch / MessageThreadReference | Relating + Messaging |
| Contributions tab | ContributionReference / RelationshipSignal | External / Payment / Relating signal |
| Memberships tab | MembershipReference / RelationshipSignal | External / Relating signal |
| Events tab | EventReference / RelationshipSignal | External / Relating signal |
| Groups | Segment / TargetList concept | Relating |
| Notes tab | Note / TimelineEvent | Relating |
| Tags tab | Source / Segment / metadata tag concept | Relating |
| Change log | Audit signal, do not implement in Relating if global audit exists | Auditing / Relating signal |
| Deduping and merging | DuplicateCandidate / MergeProposal | Relating + Vendoring |
| Search Kit displays | ViewDefinition / ViewFilter / ViewColumn / DashboardDefinition | Relating metadata |
| Communications preferences / privacy options | RelationshipCommunicationPreference signal | Relating + Accessing/Compliance |

## Nonprofit/community extensions

Relating should support reference objects without owning external business modules:

```text
MembershipReference
ContributionReference
EventReference
CampaignReference
MessageThreadReference
DocumentReference
```

These references allow relationship timeline and segmentation without pulling accounting, event management, donation management, or mailing infrastructure into Relating.

## Future skeleton candidates

```text
RelationshipCommunicationPreference
RelationshipConsentSignal
RelationshipSegmentMembership
RelationshipLifecycleMilestone
RelationshipSearchDisplay
RelationshipReportDefinition
```

These are candidates only. They should be added when the business chain needs them, not as CRUD objects.
