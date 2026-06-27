<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Value\NeighborSignalEnvelope;

interface NeighborSignalRouterInterface
{
    public function routeNeighborSignal(NeighborSignalEnvelope $signal): void;

    public function routesToRelationship(NeighborSignalEnvelope $signal): bool;
}
