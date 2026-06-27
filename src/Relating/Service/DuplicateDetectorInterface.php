<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\DuplicateCandidate;

interface DuplicateDetectorInterface
{
    /**
     * @param array<string, mixed> $signals
     * @return list<DuplicateCandidate>
     */
    public function detectCandidatesForTarget(string $targetType, string $targetReference, array $signals = []): array;
}
