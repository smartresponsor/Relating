<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Lead;
use App\Entity\LeadQualification;

interface LeadQualifierInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function qualifyLeadForRelationship(Lead $lead, array $context = []): LeadQualification;
}
