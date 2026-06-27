<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\CaseRecord;

interface CaseTriageServiceInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function triageCaseForRelationship(CaseRecord $caseRecord, array $context = []): CaseRecord;
}
