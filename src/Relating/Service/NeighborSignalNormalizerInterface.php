<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Enum\NeighborComponent;
use App\Relating\Value\NeighborSignalEnvelope;

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
