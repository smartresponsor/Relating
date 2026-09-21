<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationAutomationRule;

interface RelationAutomationRuleRepositoryInterface
{
    public function rememberPublished(RelationAutomationRule $rule): void;

    public function ruleOf(string $ruleReference): ?RelationAutomationRule;

    /** @return list<RelationAutomationRule> */
    public function activeRulesForTrigger(string $triggerKind): array;

    /** @return list<RelationAutomationRule> */
    public function rulesForSafetyLevel(string $safetyLevel): array;
}
