<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Policy\RelationPolicyDecisionResult;

interface RelationRelatingPolicyRegistryInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function decideBusinessAction(string $businessAction, array $context = []): RelationPolicyDecisionResult;
}
