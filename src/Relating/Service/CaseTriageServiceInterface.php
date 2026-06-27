<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\CaseRecord;

interface CaseTriageServiceInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function triageCaseForRelationship(CaseRecord $caseRecord, array $context = []): CaseRecord;
}
