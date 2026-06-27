<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Value\NeighborReference;

interface RelatingReferencePolicyInterface
{
    public function decideReferenceUsage(NeighborReference $reference, string $businessAction): PolicyDecisionResult;
}
