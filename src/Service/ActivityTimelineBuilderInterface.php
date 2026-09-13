<?php

declare(strict_types=1);

namespace App\Service;

use App\Snapshot\View\ActivityTimelineView;

interface ActivityTimelineBuilderInterface
{
    public function buildTimelineForTarget(string $targetType, string $targetReference): ActivityTimelineView;
}
