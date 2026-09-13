<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class ActivityCalendarView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['rangeStart', 'rangeEnd', 'items'];
    }
}
