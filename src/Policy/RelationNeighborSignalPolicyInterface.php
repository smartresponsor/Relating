<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\ValueObject\RelationNeighborSignalEnvelope;

interface RelationNeighborSignalPolicyInterface
{
    public function decideNeighborSignalIngestion(RelationNeighborSignalEnvelope $signal): RelationPolicyDecisionResult;
}
