<?php

declare(strict_types=1);

namespace App\Service;

use App\Event\AbstractRelatingEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final readonly class DispatchingRelatingBusinessEventDispatcher implements RelatingBusinessEventRecorderInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function recordBusinessEvent(AbstractRelatingEvent $event): void
    {
        $this->eventDispatcher->dispatch($event, $event->name());
    }
}
