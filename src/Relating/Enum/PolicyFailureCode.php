<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum PolicyFailureCode: string
{
    case MissingVendorReference = 'missing_vendor_reference';
    case MissingRelationshipReference = 'missing_relationship_reference';
    case MissingLeadReference = 'missing_lead_reference';
    case MissingOpportunityReference = 'missing_opportunity_reference';
    case InvalidTransition = 'invalid_transition';
    case ScoreOutOfRange = 'score_out_of_range';
    case NeighborReferenceNotAllowed = 'neighbor_reference_not_allowed';
    case AccessNotGranted = 'access_not_granted';
    case PayloadInvalid = 'payload_invalid';
    case RequiresHumanReview = 'requires_human_review';
}
