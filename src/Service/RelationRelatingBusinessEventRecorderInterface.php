<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Event\RelationAbstractRelatingEvent;

interface RelationRelatingBusinessEventRecorderInterface
{
    public function recordBusinessEvent(RelationAbstractRelatingEvent $event): void;
}
