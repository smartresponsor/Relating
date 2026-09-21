<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationLead;

interface RelationLeadRepositoryInterface
{
    public function rememberCaptured(RelationLead $lead): void;

    public function rememberEnriched(RelationLead $lead): void;

    public function rememberQualified(RelationLead $lead): void;

    public function rememberRejected(RelationLead $lead): void;

    public function rememberConverted(RelationLead $lead): void;

    public function leadOf(string $leadReference): ?RelationLead;

    /** @return list<RelationLead> */
    public function activeLeadsForRelationship(string $relationshipReference): array;

    /** @return list<RelationLead> */
    public function duplicateCandidatesForSignal(string $signalKind, string $signalValue): array;
}
