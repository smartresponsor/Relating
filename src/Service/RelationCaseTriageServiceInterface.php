<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationCaseRecord;

interface RelationCaseTriageServiceInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function triageCaseForRelationship(RelationCaseRecord $caseRecord, array $context = []): RelationCaseRecord;
}
