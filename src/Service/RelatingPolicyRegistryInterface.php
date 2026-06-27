<?php

declare(strict_types=1);

namespace App\Service;

use App\Policy\PolicyDecisionResult;

interface RelatingPolicyRegistryInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function decideBusinessAction(string $businessAction, array $context = []): PolicyDecisionResult;
}
