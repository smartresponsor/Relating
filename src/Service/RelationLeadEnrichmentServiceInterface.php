<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLead;

interface RelationLeadEnrichmentServiceInterface
{
    /**
     * @param array<string, mixed> $enrichment
     */
    public function enrichLeadWithVerifiedSignals(RelationLead $lead, array $enrichment): RelationLead;
}
