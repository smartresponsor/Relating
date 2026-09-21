<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Event\RelationAbstractRelatingEvent;

interface RelationAutomationTriggerMatcherInterface
{
    /**
     * @return list<string> automation rule references selected by the business event
     */
    public function rulesTriggeredBy(RelationAbstractRelatingEvent $event): array;
}
