<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\DuplicateCandidate;

interface DuplicateCandidateRepositoryInterface
{
    public function rememberDetected(DuplicateCandidate $candidate): void;

    public function rememberReviewed(DuplicateCandidate $candidate): void;

    public function candidateOf(string $candidateReference): ?DuplicateCandidate;

    /** @return list<DuplicateCandidate> */
    public function openCandidatesForTarget(string $targetType, string $targetReference): array;
}
