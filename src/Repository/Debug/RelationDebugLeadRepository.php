<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationLead;
use App\Relating\Repository\RelationLeadRepositoryInterface;

final readonly class RelationDebugLeadRepository implements RelationLeadRepositoryInterface
{
    private const BUCKET = 'lead';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberCaptured(RelationLead $lead): void
    {
        $this->remember($lead);
    }

    public function rememberEnriched(RelationLead $lead): void
    {
        $this->remember($lead);
    }

    public function rememberQualified(RelationLead $lead): void
    {
        $this->remember($lead);
    }

    public function rememberRejected(RelationLead $lead): void
    {
        $this->remember($lead);
    }

    public function rememberConverted(RelationLead $lead): void
    {
        $this->remember($lead);
    }

    public function leadOf(string $leadReference): ?RelationLead
    {
        $lead = $this->store->one(self::BUCKET, $leadReference);

        return $lead instanceof RelationLead ? $lead : null;
    }

    public function activeLeadsForRelationship(string $relationshipReference): array
    {
        return $this->allLeads();
    }

    public function duplicateCandidatesForSignal(string $signalKind, string $signalValue): array
    {
        return '' === trim($signalValue) ? [] : $this->allLeads();
    }

    private function remember(RelationLead $lead): void
    {
        $this->store->remember(self::BUCKET, $lead->id(), $lead);
    }

    private function allLeads(): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationLead,
        ));
    }
}
