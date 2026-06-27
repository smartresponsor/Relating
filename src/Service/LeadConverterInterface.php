<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Lead;
use App\Entity\LeadConversion;

interface LeadConverterInterface
{
    public function convertQualifiedLeadToRelationship(Lead $lead, string $vendorReference, ?string $pipelineReference = null): LeadConversion;
}
