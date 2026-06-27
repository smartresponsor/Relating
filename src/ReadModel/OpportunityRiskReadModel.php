<?php

declare(strict_types=1);


namespace App\ReadModel;

use App\Enum\ProjectionStatus;
use App\Enum\ReadModelKind;

final readonly class OpportunityRiskReadModel extends AbstractRelatingReadModel
{
    /**
     * @param list<string> $riskReasonCodes
     */
    public function __construct(
        string $opportunityReference,
        private int $riskScore,
        private string $riskLevel,
        private array $riskReasonCodes = [],
        private string $nextActionReference = '',
        ProjectionStatus $status = ProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(ReadModelKind::OpportunityRisk, $opportunityReference, $status, $projectedAt);

        if ($this->riskScore < 0 || $this->riskScore > 100) {
            throw new \InvalidArgumentException('Risk score must be between 0 and 100.');
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        return $this->withEnvelope([
            'opportunityReference' => $this->reference(),
            'riskScore' => $this->riskScore,
            'riskLevel' => $this->riskLevel,
            'riskReasonCodes' => $this->riskReasonCodes,
            'nextActionReference' => $this->nextActionReference,
        ]);
    }
}
