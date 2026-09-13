<?php

declare(strict_types=1);

namespace App\Snapshot;

use App\Enum\ForecastCategory;
use App\Enum\ProjectionStatus;
use App\Enum\ReadModelKind;

final readonly class OpportunityForecastReadModel extends AbstractRelatingReadModel
{
    public function __construct(
        string $opportunityReference,
        private string $pipelineReference,
        private string $stageReference,
        private int $probabilityPercent,
        private ForecastCategory $forecastCategory,
        private int $expectedValueMinor,
        private string $currency,
        private ?\DateTimeImmutable $expectedCloseAt = null,
        ProjectionStatus $status = ProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(ReadModelKind::OpportunityForecast, $opportunityReference, $status, $projectedAt);

        if ($this->probabilityPercent < 0 || $this->probabilityPercent > 100) {
            throw new \InvalidArgumentException('Probability percent must be between 0 and 100.');
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        return $this->withEnvelope([
            'opportunityReference' => $this->reference(),
            'pipelineReference' => $this->pipelineReference,
            'stageReference' => $this->stageReference,
            'probabilityPercent' => $this->probabilityPercent,
            'forecastCategory' => $this->forecastCategory->value,
            'expectedValueMinor' => $this->expectedValueMinor,
            'currency' => $this->currency,
            'expectedCloseAt' => $this->expectedCloseAt?->format(\DATE_ATOM),
        ]);
    }
}
