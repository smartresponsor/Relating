<?php

declare(strict_types=1);

namespace App\Relating\Debug;

use App\Relating\Entity\Lead;
use App\Relating\Repository\LeadRepositoryInterface;

final readonly class DebugLeadRepository implements LeadRepositoryInterface
{
    private const BUCKET = 'lead';

    public function __construct(
        private DebugRelatingObjectStore $store,
    ) {
    }

    public function rememberCaptured(Lead $lead): void
    {
        $this->remember($lead);
    }

    public function rememberEnriched(Lead $lead): void
    {
        $this->remember($lead);
    }

    public function rememberQualified(Lead $lead): void
    {
        $this->remember($lead);
    }

    public function rememberRejected(Lead $lead): void
    {
        $this->remember($lead);
    }

    public function rememberConverted(Lead $lead): void
    {
        $this->remember($lead);
    }

    public function leadOf(string $leadReference): ?Lead
    {
        $lead = $this->store->one(self::BUCKET, $leadReference);

        return $lead instanceof Lead ? $lead : null;
    }

    public function activeLeadsForRelationship(string $relationshipReference): array
    {
        return $this->allLeads();
    }

    public function duplicateCandidatesForSignal(string $signalKind, string $signalValue): array
    {
        return trim($signalValue) === '' ? [] : $this->allLeads();
    }

    private function remember(Lead $lead): void
    {
        $this->store->remember(self::BUCKET, $lead->id(), $lead);
    }

    private function allLeads(): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof Lead,
        ));
    }
}
