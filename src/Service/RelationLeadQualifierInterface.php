<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLead;
use App\Relating\Entity\RelationLeadQualification;

interface RelationLeadQualifierInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function qualifyLeadForRelationship(RelationLead $lead, array $context = []): RelationLeadQualification;
}
