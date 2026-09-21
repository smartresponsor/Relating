<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationshipParticipantRole: string
{
    case Primary = 'primary';
    case DecisionMaker = 'decision_maker';
    case Influencer = 'influencer';
    case Billing = 'billing';
    case Technical = 'technical';
    case Support = 'support';
    case Partner = 'partner';
}
