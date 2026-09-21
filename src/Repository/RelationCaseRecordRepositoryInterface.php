<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationCaseRecord;

interface RelationCaseRecordRepositoryInterface
{
    public function rememberOpened(RelationCaseRecord $caseRecord): void;

    public function rememberTriaged(RelationCaseRecord $caseRecord): void;

    public function rememberEscalated(RelationCaseRecord $caseRecord): void;

    public function rememberResolved(RelationCaseRecord $caseRecord): void;

    public function rememberClosed(RelationCaseRecord $caseRecord): void;

    public function caseOf(string $caseReference): ?RelationCaseRecord;

    /** @return list<RelationCaseRecord> */
    public function openCasesForRelationship(string $relationshipReference): array;
}
