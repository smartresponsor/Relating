<?php

declare(strict_types=1);

namespace App\View;

final readonly class TraceEntryView extends AbstractArrayView
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
