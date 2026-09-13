<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\TimelineRecord;
use App\Event\AbstractRelatingEvent;

interface RelationshipTimelineProjectorInterface
{
    public function projectBusinessEvent(AbstractRelatingEvent $event): TimelineRecord;
}
