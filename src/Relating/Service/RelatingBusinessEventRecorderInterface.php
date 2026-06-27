<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Event\AbstractRelatingEvent;

interface RelatingBusinessEventRecorderInterface
{
    public function recordBusinessEvent(AbstractRelatingEvent $event): void;
}
