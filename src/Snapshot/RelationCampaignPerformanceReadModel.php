<?php

declare(strict_types=1);

namespace App\Relating\Snapshot;

use App\Relating\Enum\RelationProjectionStatus;
use App\Relating\Enum\RelationReadModelKind;

final readonly class RelationCampaignPerformanceReadModel extends RelationAbstractRelatingReadModel
{
    public function __construct(
        string $campaignReference,
        private int $memberCount,
        private int $touchCount,
        private int $responseCount,
        private int $openedOpportunityCount,
        private int $influencedValueMinor,
        private string $currency,
        RelationProjectionStatus $status = RelationProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(RelationReadModelKind::CampaignPerformance, $campaignReference, $status, $projectedAt);
    }

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        return $this->withEnvelope([
            'campaignReference' => $this->reference(),
            'memberCount' => $this->memberCount,
            'touchCount' => $this->touchCount,
            'responseCount' => $this->responseCount,
            'openedOpportunityCount' => $this->openedOpportunityCount,
            'influencedValueMinor' => $this->influencedValueMinor,
            'currency' => $this->currency,
        ]);
    }
}
