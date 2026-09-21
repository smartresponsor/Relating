<?php

declare(strict_types=1);

namespace App\Relating\Service;

interface RelationAutomationConditionEvaluatorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function conditionMatchesBusinessContext(string $conditionReference, array $context): bool;
}
