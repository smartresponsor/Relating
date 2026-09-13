<?php

declare(strict_types=1);

namespace App\Service;

use App\Event\AbstractRelatingEvent;

interface AutomationTriggerMatcherInterface
{
    /**
     * @return list<string> automation rule references selected by the business event
     */
    public function rulesTriggeredBy(AbstractRelatingEvent $event): array;
}
