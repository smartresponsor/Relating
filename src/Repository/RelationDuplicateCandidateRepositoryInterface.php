<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationDuplicateCandidate;

interface RelationDuplicateCandidateRepositoryInterface
{
    public function rememberDetected(RelationDuplicateCandidate $candidate): void;

    public function rememberReviewed(RelationDuplicateCandidate $candidate): void;

    public function candidateOf(string $candidateReference): ?RelationDuplicateCandidate;

    /** @return list<RelationDuplicateCandidate> */
    public function openCandidatesForTarget(string $targetType, string $targetReference): array;
}
