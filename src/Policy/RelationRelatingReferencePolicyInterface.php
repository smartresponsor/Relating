<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\ValueObject\RelationNeighborReference;

interface RelationRelatingReferencePolicyInterface
{
    public function decideReferenceUsage(RelationNeighborReference $reference, string $businessAction): RelationPolicyDecisionResult;
}
