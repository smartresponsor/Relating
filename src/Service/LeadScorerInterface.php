<?php

declare(strict_types=1);

namespace App\Service;

interface LeadScorerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function scoreLeadReference(string $leadReference, array $context = []): int;
}
