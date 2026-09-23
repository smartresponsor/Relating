<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationCaseRecordEntity;

interface RelationCaseTriageServiceInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function triageCaseForRelationship(RelationCaseRecordEntity $caseRecord, array $context = []): RelationCaseRecordEntity;
}
