<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class AutomationRuleView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['ruleId', 'code', 'enabled'];
    }
}
