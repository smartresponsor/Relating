<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationshipSignalEntity;

interface RelationshipSignalIngestorInterface
{
    /**
     * @param array<string, mixed> $payload
     */
    public function ingestNeighborSignal(string $sourceComponent, string $signalKind, array $payload): RelationshipSignalEntity;
}
