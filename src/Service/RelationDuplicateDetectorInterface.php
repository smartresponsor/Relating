<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationDuplicateCandidate;

interface RelationDuplicateDetectorInterface
{
    /**
     * @param array<string, mixed> $signals
     *
     * @return list<RelationDuplicateCandidate>
     */
    public function detectCandidatesForTarget(string $targetType, string $targetReference, array $signals = []): array;
}
