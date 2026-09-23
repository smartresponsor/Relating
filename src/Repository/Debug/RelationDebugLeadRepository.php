<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationLeadEntity;
use App\Relating\Repository\RelationLeadRepositoryInterface;

final readonly class RelationDebugLeadRepository implements RelationLeadRepositoryInterface
{
    private const BUCKET = 'lead';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberCaptured(RelationLeadEntity $lead): void
    {
        $this->remember($lead);
    }

    public function rememberEnriched(RelationLeadEntity $lead): void
    {
        $this->remember($lead);
    }

    public function rememberQualified(RelationLeadEntity $lead): void
    {
        $this->remember($lead);
    }

    public function rememberRejected(RelationLeadEntity $lead): void
    {
        $this->remember($lead);
    }

    public function rememberConverted(RelationLeadEntity $lead): void
    {
        $this->remember($lead);
    }

    public function leadOf(string $leadReference): ?RelationLeadEntity
    {
        $lead = $this->store->one(self::BUCKET, $leadReference);

        return $lead instanceof RelationLeadEntity ? $lead : null;
    }

    public function activeLeadsForRelationship(string $relationshipReference): array
    {
        return $this->allLeads();
    }

    public function leadsForRelationship(string $relationshipReference): array
    {
        return $this->allLeads();
    }

    public function duplicateCandidatesForSignal(string $signalKind, string $signalValue): array
    {
        return '' === trim($signalValue) ? [] : $this->allLeads();
    }

    private function remember(RelationLeadEntity $lead): void
    {
        $this->store->remember(self::BUCKET, $lead->id(), $lead);
    }

    /** @return list<RelationLeadEntity> */
    private function allLeads(): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationLeadEntity,
        ));
    }
}
