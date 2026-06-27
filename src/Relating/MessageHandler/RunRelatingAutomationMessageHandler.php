<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Message\RunRelatingAutomationMessage;
use App\Relating\Service\RelatingAutomationRunnerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RunRelatingAutomationMessageHandler
{
    public function __construct(private RelatingAutomationRunnerInterface $runner)
    {
    }

    public function __invoke(RunRelatingAutomationMessage $message): void
    {
        $this->runner->runAutomationForBusinessTrigger(
            $message->targetReference,
            BusinessMessagePayload::array($message->payload, 'payload'),
        );
    }
}
