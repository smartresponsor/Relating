<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationCaseRecordEntity;

interface RelationCaseRecordRepositoryInterface
{
    public function rememberOpened(RelationCaseRecordEntity $caseRecord): void;

    public function rememberTriaged(RelationCaseRecordEntity $caseRecord): void;

    public function rememberEscalated(RelationCaseRecordEntity $caseRecord): void;

    public function rememberResolved(RelationCaseRecordEntity $caseRecord): void;

    public function rememberClosed(RelationCaseRecordEntity $caseRecord): void;

    public function caseOf(string $caseReference): ?RelationCaseRecordEntity;

    /** @return list<RelationCaseRecordEntity> */
    public function openCasesForRelationship(string $relationshipReference): array;
}
