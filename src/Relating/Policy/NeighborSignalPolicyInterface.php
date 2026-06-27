<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Value\NeighborSignalEnvelope;

interface NeighborSignalPolicyInterface
{
    public function decideNeighborSignalIngestion(NeighborSignalEnvelope $signal): PolicyDecisionResult;
}
