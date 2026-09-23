<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLeadConversionEntity;
use App\Relating\Entity\RelationLeadEntity;

interface RelationLeadConverterInterface
{
    public function convertQualifiedLeadToRelationship(RelationLeadEntity $lead, string $vendorReference, ?string $pipelineReference = null): RelationLeadConversionEntity;
}
