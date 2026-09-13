<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\NeighborSignalEnvelope;

interface NeighborSignalRouterInterface
{
    public function routeNeighborSignal(NeighborSignalEnvelope $signal): void;

    public function routesToRelationship(NeighborSignalEnvelope $signal): bool;
}
