<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationAutomationRunView extends RelationAbstractArrayView
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
