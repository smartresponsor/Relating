<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationRunRelatingAutomationMessage;
use App\Relating\Service\RelationRelatingAutomationRunnerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationRunRelatingAutomationMessageHandler
{
    public function __construct(private RelationRelatingAutomationRunnerInterface $runner)
    {
    }

    public function __invoke(RelationRunRelatingAutomationMessage $message): void
    {
        $this->runner->runAutomationForBusinessTrigger(
            $message->targetReference,
            RelationBusinessMessagePayload::array($message->payload, 'payload'),
        );
    }
}
