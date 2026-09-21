<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationTraceEntryView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'trace.entry';
    }

    public static function expectedKeys(): array
    {
        return ['correlationId', 'kind', 'subject', 'outcome', 'recordedAt'];
    }
}
