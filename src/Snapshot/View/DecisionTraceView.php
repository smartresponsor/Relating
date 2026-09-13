<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class DecisionTraceView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'trace.decision';
    }

    public static function expectedKeys(): array
    {
        return ['correlationId', 'decisionKind', 'subject', 'actor', 'outcome', 'decidedAt'];
    }
}
