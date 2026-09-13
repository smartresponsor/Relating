<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class CallSummaryView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['activityId', 'summary', 'participants'];
    }
}
