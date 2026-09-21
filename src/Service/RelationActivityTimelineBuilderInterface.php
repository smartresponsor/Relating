<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Snapshot\View\RelationActivityTimelineView;

interface RelationActivityTimelineBuilderInterface
{
    public function buildTimelineForTarget(string $targetType, string $targetReference): RelationActivityTimelineView;
}
