<?php

declare(strict_types=1);

namespace App\Service;

interface AutomationConditionEvaluatorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function conditionMatchesBusinessContext(string $conditionReference, array $context): bool;
}
