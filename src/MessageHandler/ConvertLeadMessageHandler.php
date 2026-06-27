<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Application\Command\ConvertLeadCommand;
use App\Application\Service\ConvertLeadApplicationService;
use App\Message\ConvertLeadMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class ConvertLeadMessageHandler
{
    public function __construct(private ConvertLeadApplicationService $service)
    {
    }

    public function __invoke(ConvertLeadMessage $message): void
    {
        $this->service->convertLead(new ConvertLeadCommand(
            $message->targetReference,
            BusinessMessagePayload::string($message->payload, 'vendorReference'),
            BusinessMessagePayload::nullableString($message->payload, 'pipelineReference'),
            BusinessMessagePayload::nullableString($message->payload, 'stageReference'),
            BusinessMessagePayload::nullableString($message->payload, 'opportunityName'),
            BusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
