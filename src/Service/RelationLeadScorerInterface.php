<?php

declare(strict_types=1);

namespace App\Relating\Service;

interface RelationLeadScorerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function scoreLeadReference(string $leadReference, array $context = []): int;
}
