<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\View\ActivityTimelineView;

interface ActivityTimelineBuilderInterface
{
    public function buildTimelineForTarget(string $targetType, string $targetReference): ActivityTimelineView;
}
