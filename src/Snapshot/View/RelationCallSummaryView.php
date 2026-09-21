<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationCallSummaryView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['activityId', 'summary', 'participants'];
    }
}
