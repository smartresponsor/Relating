<?php

declare(strict_types=1);

namespace App\Policy;

use App\ValueObject\NeighborReference;

interface RelatingReferencePolicyInterface
{
    public function decideReferenceUsage(NeighborReference $reference, string $businessAction): PolicyDecisionResult;
}
