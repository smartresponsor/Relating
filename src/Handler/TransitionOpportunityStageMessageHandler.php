<?php

declare(strict_types=1);

namespace App\Handler;

use App\Command\TransitionOpportunityStageCommand;
use App\Message\TransitionOpportunityStageMessage;
use App\Service\Application\TransitionOpportunityStageApplicationService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class TransitionOpportunityStageMessageHandler
{
    public function __construct(private TransitionOpportunityStageApplicationService $service)
    {
    }

    public function __invoke(TransitionOpportunityStageMessage $message): void
    {
        $this->service->transitionOpportunityStage(new TransitionOpportunityStageCommand(
            $message->targetReference,
            BusinessMessagePayload::string($message->payload, 'stageReference'),
            BusinessMessagePayload::integer($message->payload, 'probability', 0),
            BusinessMessagePayload::string($message->payload, 'forecastCategory', 'pipeline'),
            BusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
