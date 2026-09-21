<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationActivityCalendarView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['rangeStart', 'rangeEnd', 'items'];
    }
}
