<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationDuplicateCandidateEntity;

interface RelationDuplicateCandidateRepositoryInterface
{
    public function rememberDetected(RelationDuplicateCandidateEntity $candidate): void;

    public function rememberReviewed(RelationDuplicateCandidateEntity $candidate): void;

    public function candidateOf(string $candidateReference): ?RelationDuplicateCandidateEntity;

    /** @return list<RelationDuplicateCandidateEntity> */
    public function openCandidatesForTarget(string $targetType, string $targetReference): array;
}
