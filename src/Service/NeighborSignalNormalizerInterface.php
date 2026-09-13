<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\NeighborComponent;
use App\ValueObject\NeighborSignalEnvelope;

interface NeighborSignalNormalizerInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function normalizeNeighborSignal(
        NeighborComponent $sourceComponent,
        string $signalKind,
        ?string $sourceReference,
        ?string $relationshipReference,
        array $payload = [],
    ): NeighborSignalEnvelope;
}
