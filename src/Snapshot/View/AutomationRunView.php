<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class AutomationRunView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'automation.run';
    }

    public static function expectedKeys(): array
    {
        return ['runId', 'status', 'steps', 'startedAt', 'finishedAt'];
    }
}
