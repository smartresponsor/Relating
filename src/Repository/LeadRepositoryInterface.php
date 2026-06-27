<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Lead;

interface LeadRepositoryInterface
{
    public function rememberCaptured(Lead $lead): void;

    public function rememberEnriched(Lead $lead): void;

    public function rememberQualified(Lead $lead): void;

    public function rememberRejected(Lead $lead): void;

    public function rememberConverted(Lead $lead): void;

    public function leadOf(string $leadReference): ?Lead;

    /** @return list<Lead> */
    public function activeLeadsForRelationship(string $relationshipReference): array;

    /** @return list<Lead> */
    public function duplicateCandidatesForSignal(string $signalKind, string $signalValue): array;
}
