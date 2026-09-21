<?php

declare(strict_types=1);

namespace App\Relating\Snapshot;

use App\Relating\Enum\RelationCaseSlaStatus;
use App\Relating\Enum\RelationProjectionStatus;
use App\Relating\Enum\RelationReadModelKind;

final readonly class RelationCaseSlaReadModel extends RelationAbstractRelatingReadModel
{
    public function __construct(
        string $caseReference,
        private RelationCaseSlaStatus $slaStatus,
        private ?\DateTimeImmutable $deadlineAt,
        private int $remainingSeconds,
        private bool $breached,
        private string $escalationReference = '',
        RelationProjectionStatus $status = RelationProjectionStatus::Projected,
        ?\DateTimeImmutable $projectedAt = null,
    ) {
        parent::__construct(RelationReadModelKind::CaseSla, $caseReference, $status, $projectedAt);
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
