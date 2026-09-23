<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationLeadEntity;

interface RelationLeadRepositoryInterface
{
    public function rememberCaptured(RelationLeadEntity $lead): void;

    public function rememberEnriched(RelationLeadEntity $lead): void;

    public function rememberQualified(RelationLeadEntity $lead): void;

    public function rememberRejected(RelationLeadEntity $lead): void;

    public function rememberConverted(RelationLeadEntity $lead): void;

    public function leadOf(string $leadReference): ?RelationLeadEntity;

    /** @return list<RelationLeadEntity> */
    public function activeLeadsForRelationship(string $relationshipReference): array;

    /** @return list<RelationLeadEntity> */
    public function leadsForRelationship(string $relationshipReference): array;

    /** @return list<RelationLeadEntity> */
    public function duplicateCandidatesForSignal(string $signalKind, string $signalValue): array;
}
