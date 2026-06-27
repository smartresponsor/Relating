<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CaseRecord;

interface CaseRecordRepositoryInterface
{
    public function rememberOpened(CaseRecord $caseRecord): void;

    public function rememberTriaged(CaseRecord $caseRecord): void;

    public function rememberEscalated(CaseRecord $caseRecord): void;

    public function rememberResolved(CaseRecord $caseRecord): void;

    public function rememberClosed(CaseRecord $caseRecord): void;

    public function caseOf(string $caseReference): ?CaseRecord;

    /** @return list<CaseRecord> */
    public function openCasesForRelationship(string $relationshipReference): array;
}
