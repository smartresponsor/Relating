<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\ValueObject\RelationNeighborSignalEnvelope;

interface RelationNeighborSignalRouterInterface
{
    public function routeNeighborSignal(RelationNeighborSignalEnvelope $signal): void;

    public function routesToRelationship(RelationNeighborSignalEnvelope $signal): bool;
}
