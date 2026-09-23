<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLeadEntity;
use App\Relating\Entity\RelationLeadQualificationEntity;

interface RelationLeadQualifierInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function qualifyLeadForRelationship(RelationLeadEntity $lead, array $context = []): RelationLeadQualificationEntity;
}
