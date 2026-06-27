<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class ActivityCalendarView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['rangeStart', 'rangeEnd', 'items'];
    }
}
