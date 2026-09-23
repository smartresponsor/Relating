<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLeadEntity;

interface RelationLeadEnrichmentServiceInterface
{
    /**
     * @param array<string, mixed> $enrichment
     */
    public function enrichLeadWithVerifiedSignals(RelationLeadEntity $lead, array $enrichment): RelationLeadEntity;
}
