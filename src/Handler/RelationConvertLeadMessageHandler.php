<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Command\RelationConvertLeadCommand;
use App\Relating\Message\RelationConvertLeadMessage;
use App\Relating\Service\Application\RelationConvertLeadApplicationService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationConvertLeadMessageHandler
{
    public function __construct(private RelationConvertLeadApplicationService $service)
    {
    }

    public function __invoke(RelationConvertLeadMessage $message): void
    {
        $this->service->convertLead(new RelationConvertLeadCommand(
            $message->targetReference,
            RelationBusinessMessagePayload::string($message->payload, 'vendorReference'),
            RelationBusinessMessagePayload::nullableString($message->payload, 'pipelineReference'),
            RelationBusinessMessagePayload::nullableString($message->payload, 'stageReference'),
            RelationBusinessMessagePayload::nullableString($message->payload, 'opportunityName'),
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
