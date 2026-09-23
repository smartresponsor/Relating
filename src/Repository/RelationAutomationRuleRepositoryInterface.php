<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationAutomationRuleEntity;

interface RelationAutomationRuleRepositoryInterface
{
    public function rememberPublished(RelationAutomationRuleEntity $rule): void;

    public function ruleOf(string $ruleReference): ?RelationAutomationRuleEntity;

    /** @return list<RelationAutomationRuleEntity> */
    public function activeRulesForTrigger(string $triggerKind): array;

    /** @return list<RelationAutomationRuleEntity> */
    public function rulesForSafetyLevel(string $safetyLevel): array;
}
