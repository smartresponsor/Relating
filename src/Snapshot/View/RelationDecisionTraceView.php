<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationDecisionTraceView extends RelationAbstractArrayView
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
