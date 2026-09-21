<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Event\RelationAbstractRelatingEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final readonly class RelationDispatchingRelatingBusinessEventDispatcher implements RelationRelatingBusinessEventRecorderInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function recordBusinessEvent(RelationAbstractRelatingEvent $event): void
    {
        $this->eventDispatcher->dispatch($event, $event->name());
    }
}
