<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\Lead;
use App\Relating\Entity\LeadQualification;

interface LeadQualifierInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function qualifyLeadForRelationship(Lead $lead, array $context = []): LeadQualification;
}
