<?php

declare(strict_types=1);

namespace App\Snapshot;

use App\Enum\CaseSlaStatus;
use App\Enum\ProjectionStatus;
use App\Enum\ReadModelKind;

final readonly class CaseSlaReadModel extends AbstractRelatingReadModel
{
    public function __construct(
        string $caseReference,
        private CaseSlaStatus $slaStatus,
        private ?\DateTimeImmutable $deadlineAt,
        private int $remainingSeconds,
        private bool $breached,
        private string $escalationReference = '',
        ProjectionStatus $status = ProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(ReadModelKind::CaseSla, $caseReference, $status, $projectedAt);
    }

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        return $this->withEnvelope([
            'caseReference' => $this->reference(),
            'slaStatus' => $this->slaStatus->value,
            'deadlineAt' => $this->deadlineAt?->format(\DATE_ATOM),
            'remainingSeconds' => $this->remainingSeconds,
            'breached' => $this->breached,
            'escalationReference' => $this->escalationReference,
        ]);
    }
}
