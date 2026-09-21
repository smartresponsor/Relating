<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Command\RelationTransitionOpportunityStageCommand;
use App\Relating\Message\RelationTransitionOpportunityStageMessage;
use App\Relating\Service\Application\RelationTransitionOpportunityStageApplicationService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationTransitionOpportunityStageMessageHandler
{
    public function __construct(private RelationTransitionOpportunityStageApplicationService $service)
    {
    }

    public function __invoke(RelationTransitionOpportunityStageMessage $message): void
    {
        $this->service->transitionOpportunityStage(new RelationTransitionOpportunityStageCommand(
            $message->targetReference,
            RelationBusinessMessagePayload::string($message->payload, 'stageReference'),
            RelationBusinessMessagePayload::integer($message->payload, 'probability', 0),
            RelationBusinessMessagePayload::string($message->payload, 'forecastCategory', 'pipeline'),
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
