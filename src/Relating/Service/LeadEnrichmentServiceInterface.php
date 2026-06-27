<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\Lead;

interface LeadEnrichmentServiceInterface
{
    /**
     * @param array<string, mixed> $enrichment
     */
    public function enrichLeadWithVerifiedSignals(Lead $lead, array $enrichment): Lead;
}
