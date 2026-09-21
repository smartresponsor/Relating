<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLead;
use App\Relating\Entity\RelationLeadConversion;

interface RelationLeadConverterInterface
{
    public function convertQualifiedLeadToRelationship(RelationLead $lead, string $vendorReference, ?string $pipelineReference = null): RelationLeadConversion;
}
