<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationTimelineRecord;
use App\Relating\Event\RelationAbstractRelatingEvent;

interface RelationshipTimelineProjectorInterface
{
    public function projectBusinessEvent(RelationAbstractRelatingEvent $event): RelationTimelineRecord;
}
