<?php

declare(strict_types=1);

namespace App\Policy;

use App\Value\NeighborSignalEnvelope;

interface NeighborSignalPolicyInterface
{
    public function decideNeighborSignalIngestion(NeighborSignalEnvelope $signal): PolicyDecisionResult;
}
