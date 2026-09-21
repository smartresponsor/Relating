<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Enum\RelationNeighborComponent;
use App\Relating\ValueObject\RelationNeighborSignalEnvelope;

interface RelationNeighborSignalNormalizerInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function normalizeNeighborSignal(
        RelationNeighborComponent $sourceComponent,
        string $signalKind,
        ?string $sourceReference,
        ?string $relationshipReference,
        array $payload = [],
    ): RelationNeighborSignalEnvelope;
}
