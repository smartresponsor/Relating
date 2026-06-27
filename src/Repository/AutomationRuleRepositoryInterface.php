<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AutomationRule;

interface AutomationRuleRepositoryInterface
{
    public function rememberPublished(AutomationRule $rule): void;

    public function ruleOf(string $ruleReference): ?AutomationRule;

    /** @return list<AutomationRule> */
    public function activeRulesForTrigger(string $triggerKind): array;

    /** @return list<AutomationRule> */
    public function rulesForSafetyLevel(string $safetyLevel): array;
}
