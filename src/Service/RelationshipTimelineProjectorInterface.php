<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\TimelineEvent;
use App\Event\AbstractRelatingEvent;

interface RelationshipTimelineProjectorInterface
{
    public function projectBusinessEvent(AbstractRelatingEvent $event): TimelineEvent;
}
