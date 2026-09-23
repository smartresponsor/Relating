<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationDuplicateCandidateEntity;

interface RelationDuplicateDetectorInterface
{
    /**
     * @param array<string, mixed> $signals
     *
     * @return list<RelationDuplicateCandidateEntity>
     */
    public function detectCandidatesForTarget(string $targetType, string $targetReference, array $signals = []): array;
}
