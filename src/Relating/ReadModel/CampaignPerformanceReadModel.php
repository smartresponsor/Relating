<?php

declare(strict_types=1);


namespace App\Relating\ReadModel;

use App\Relating\Enum\ProjectionStatus;
use App\Relating\Enum\ReadModelKind;

final readonly class CampaignPerformanceReadModel extends AbstractRelatingReadModel
{
    public function __construct(
        string $campaignReference,
        private int $memberCount,
        private int $touchCount,
        private int $responseCount,
        private int $openedOpportunityCount,
        private int $influencedValueMinor,
        private string $currency,
        ProjectionStatus $status = ProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(ReadModelKind::CampaignPerformance, $campaignReference, $status, $projectedAt);
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
