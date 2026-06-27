<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\Lead;
use App\Relating\Entity\LeadConversion;

interface LeadConverterInterface
{
    public function convertQualifiedLeadToRelationship(Lead $lead, string $vendorReference, ?string $pipelineReference = null): LeadConversion;
}
